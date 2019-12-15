<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeadQuaterIncomeController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
	/**
	 * Index for income cash book
	 *
	 * @return Response
	 */
	public function index()
	{
		$getAllInvestorIncome = DB::table('investor_income_tb')
			->join('invester_tb', 'invester_tb.id', '=', 'investor_income_tb.investor_id')
			->select('investor_income_tb.*', 'invester_tb.name')
			->where('investor_income_tb.delete_flag', 0)
			->paginate(15);

		$getAllProjectIncome = DB::table('project_income_tb')
			->join('project_tb', 'project_tb.id', '=', 'project_income_tb.project_id')
			->select('project_income_tb.*', 'project_tb.name')
			->where('project_income_tb.delete_flag', 0)
			->paginate(15);

		$getAllBankIncome = DB::table('bank_detail_tb')
			->join('bank_tb', 'bank_tb.id', '=', 'bank_detail_tb.bank_id')
			->select('bank_detail_tb.*', 'bank_tb.name')
			->where('bank_detail_tb.delete_flag', 0)
			->paginate(15);
        $loanDetail = DB::table('loan_detail_tb')->orderby('created_at', 'desc')
            ->where('delete_flag', 0)
            ->paginate(15);


		$getAllPaymentOrderIncome = DB::table('payment_order_detail_tb')
			->join('payment_order_tb', 'payment_order_tb.id', '=', 'payment_order_detail_tb.payment_order_id')
			->select('payment_order_detail_tb.*', 'payment_order_tb.name')
			->where('payment_order_detail_tb.delete_flag', 0)
			->paginate(15);

		$getAllPurchaseGauranteeIncome = DB::table('purchase_guarantee_income_tb')
			->join('purchase_guarantee_tb', 'purchase_guarantee_tb.id', '=', 'purchase_guarantee_income_tb.purchase_guarantee_id')
			->select('purchase_guarantee_income_tb.*', 'purchase_guarantee_tb.name')
			->where('purchase_guarantee_income_tb.delete_flag', 0)
			->paginate(15);

		$getAllTinderRegisteration = DB::table('popg_tb')
            ->join('account_head_tb','account_head_tb.id','=','popg_tb.account_head')
            ->select('popg_tb.*','account_head_tb.account_head_type')->where('popg_tb.delete_flag',0)
            ->paginate(15);
		return view('head_quater.income_cashbook', compact('getAllInvestorIncome', 'getAllProjectIncome', 'getAllBankIncome', 'getAllPaymentOrderIncome', 'getAllPurchaseGauranteeIncome','loanDetail','getAllTinderRegisteration'));
	}
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function create()
	{
		$investors = $this->getAllInvestor();
		$projects = $this->getAllProject();
		$banks = $this->getAllBank();
        $accountHead = $this->getAllAccountHead();
		return view('head_quater.add_income', compact('investors', 'projects', 'banks', 'paymentOrders', 'purchaseGuarantees', 'accountHead'));
	}

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ReceivePaymentOrder($id){

        $paymentOrders = DB::table('payment_order_tb')->orderby('created_at', 'desc')
            ->where('id',$id)
            ->where('delete_flag', 0)->get();
        return view('head_quater.receive_payment_order',compact("paymentOrders"));
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
	public function storeInvestorIncome(Request $request)
	{
		$investorIncomeReq = [
			'investor_id' => $request->investor,
            'account_head_id' => $request->accountHead,
			'payment_type' => $request->optionsRadios,
			'amount' => $request->amount,
			'description' => $request->description
		];
		$specification_id = $request->investor;
		$getCashbookInfo = $this->getCashbookInfo($request, $request->accountHead, $specification_id);
		try {
            DB::beginTransaction();
			$investorDetail = DB::table('invester_detail_tb')->orderby('created_at', 'desc')
				->where('delete_flag', 0)
				->where('investor_id', $request->investor)
				->get();

			if (sizeof($investorDetail) == 0) {
				DB::table('investor_income_tb')->insert([
					'investor_id' => $request->investor,
					'total_income_balance' => $request->amount,
				]);
			} else {
				$totalBalance = DB::table('investor_income_tb')->where('investor_id', $request->investor)->first();
				if($totalBalance) {
                    DB::table('investor_income_tb')->where('investor_id', $request->investor)->update(['total_income_balance' => $totalBalance->total_income_balance + $request->amount]);
                }
			}

			$insertInvestorIncome = DB::table('invester_detail_tb')->insert($investorIncomeReq);
			if ($insertInvestorIncome) {
                $getLastId = DB::getPdo()->lastInsertId(); //get Last Id for Investor Income Detail
                $getCashbookInfo['investor_income_detail_id'] = $getLastId;
			    DB::table('cash_book_tb')->insert($getCashbookInfo);
            }
            DB::commit();
			return redirect('/head_quater/income_cashbook');

		} catch (Exception $e) {
            DB::rollBack();
			return $e->getMessage();
		}
	}

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
	public function storeProjectIncome(Request $request)
	{

		$projectIncomeReq = [
			'project_id' => $request->project,
			'payment_type' => $request->optionsRadios,
			'transfer_type' => 'income',
			'amount' => $request->amount,
			'description' => $request->description,
            'account_head_id' => $request->accountHead,

		];
		$specification_id = $request->project;
		$getCashBookInfo = $this->getCashBookInfo($request, $request->accountHead, $specification_id);

		try {
		    DB::beginTransaction();
			// check row count of project detail 
			$projectDetail = DB::table('project_detail_tb')->orderby('created_at', 'desc')
				->where('delete_flag', 0)
				->where('project_id', $request->project)
				->get();

			if (sizeof($projectDetail) == 0) {
				DB::table('project_income_tb')->insert([
					'project_id' => $request->project,
					'total_income_balance' => $request->amount,
				]);
			} else {
				// calculate total balance
				$totalBalance = DB::table('project_income_tb')->where('project_id', $request->project)->first();
				DB::table('project_income_tb')->where('project_id', $request->project)->update(['total_income_balance' => $totalBalance->total_income_balance + $request->amount]);
			}
			$insertProjectIncome = DB::table('project_detail_tb')->insert($projectIncomeReq);
			if($insertProjectIncome) {
                $getLastId = DB::getPdo()->lastInsertId(); //get Last Id for project Income Detail
                $getCashBookInfo['project_income_detail_id'] = $getLastId;
                DB::table('cash_book_tb')->insert($getCashBookInfo);
            }
            DB::commit();
			return redirect('/head_quater/income_cashbook/project');
		} catch (\Exception $e) {
		    DB::rollBack();
			return $e->getMessage();
		}
	}

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
	public function storeBankIncome(Request $request)
	{

		$bankLoanReq = [
			'bank_detail_id' => $request->bank,
			'loan_amount' => $request->amount,
			'loan_date' => $request->loan_date,
			'payment_type' => $request->optionsRadios,
			'description' => $request->description,
            'account_head_id' => $request->accountHead,
		];

		$specification_id = $request->bank;

		$getCashBookInfo = $this->getCashBookInfo($request, $request->accountHead, $specification_id);

		try {
            DB::beginTransaction();
			$loanDetail = DB::table('loan_detail_tb')->orderby('created_at', 'desc')
				->where('delete_flag', 0)
				->where('bank_detail_id', $request->bank)
				->get();
			if (sizeof($loanDetail) == 0) {

				$insertBankLoanIncome = DB::table('bank_detail_tb')->insert([
					'bank_id' => $request->bank,
					'total_loan_amount' => $request->amount,
					'loan_date' => $request->loan_date,
					'description' => $request->description,
				]);

			} else {
				// calculate total balance
				$totalBalance = DB::table('bank_detail_tb')->where('bank_id', $request->bank)->first();

				$updateTotalBalance = DB::table('bank_detail_tb')->where('bank_id', $request->bank)->update(['total_loan_amount' => $totalBalance->total_loan_amount + $request->amount]);
			}
			$insertBankIncome = DB::table('loan_detail_tb')->insert($bankLoanReq);
			if($insertBankIncome) {
                $getLastId = DB::getPdo()->lastInsertId(); //get Last Id for project Income Detail
                $getCashBookInfo['bank_income_detail_id'] = $getLastId;
                $insertBankIncomeIntoCashBook = DB::table('cash_book_tb')->insert($getCashBookInfo);
            }
            DB::commit();
			return redirect('/head_quater/income_cashbook/bank_loan');
		} catch (\Exception $e) {
		    DB::rollBack();
			return $e->getMessage();
		}
	}

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
	public function storePaymentOrderIncome(Request $request)
	{
		$POIncomeReq = [
			'payment_order_id' => $request->paymentorder,
			'payment_type' => $request->optionsRadios,
			'receive_amount' => $request->amount,
			'receive_date' => $request->receive_date,
			'description' => $request->description,
		];

		$specification_id = $request->paymentorder;

		$getCashBookInfo = $this->getCashBookInfo($request, $request->accountHead, $specification_id);
		try {
            DB::beginTransaction();
			// check row count of project detail
			$paymentOrderDetail = DB::table('payment_order_detail_tb')->orderby('created_at', 'desc')
				->where('delete_flag', 0)
				->where('payment_order_id', $request->paymentorder)
				->get();
			if (sizeof($paymentOrderDetail) != 0) {
                foreach ($paymentOrderDetail as $paymentOrderDetailbyId) {
                    if($paymentOrderDetailbyId->receive_amount == null) {
                        $paymentOrderDetailbyId->receive_amount = 0;
                    }
                    $update_amount = $paymentOrderDetailbyId->receive_amount + $request->amount;
                }
                DB::update('update payment_order_detail_tb set receive_amount = ?  where payment_order_id = ?',[$update_amount,$request->paymentorder]);
			}
			
			DB::table('cash_book_tb')->insert($getCashBookInfo);
			DB::commit();
			return redirect('/head_quater/income_cashbook');
		} catch (Exception $e) {
		    DB::rollBack();
			return $e->getMessage();
		}
	}

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
	public function storePurchaseGuaranteeIncome(Request $request)
	{

		$PGIncomeReq = [
			'purchase_guarantee_id' => $request->purchaseguarantee,
			'payment_type' => $request->optionsRadios,
			'receive_amount' => $request->amount,
			'receive_date' => $request->receive_date,
			'description' => $request->description,
		];

		$specification_id = $request->purchaseguarantee;

		$getCashBookInfo = $this->getCashBookInfo($request, $request->accountHead, $specification_id);

		try {

			$paymentOrderDetail = DB::table('purchase_guarantee_detail_tb')->orderby('created_at', 'desc')
				->where('delete_flag', 0)
				->where('purchase_guarantee_id', $request->purchaseguarantee)
				->get();

			if (sizeof($paymentOrderDetail) == 0) {
				$insertProjectIncome = DB::table('purchase_guarantee_income_tb')->insert([
					'purchase_guarantee_id' => $request->purchaseguarantee,
					'total_income_balance' => $request->amount,
					'with_draw' => $request->receive_date,
					'description' => $request->description,
				]);
			} else {

				$totalBalance = DB::table('purchase_guarantee_income_tb')->where('purchase_guarantee_id', $request->purchaseguarantee)->first();
				$updateTotalBalance = DB::table('purchase_guarantee_income_tb')->where('purchase_guarantee_id', $request->purchaseguarantee)->update(['total_income_balance' => $totalBalance->total_income_balance + $request->amount]);
			}
			$insertPaymentOrderIncome = DB::table('purchase_guarantee_detail_tb')->insert($PGIncomeReq);
			$insertPaymentOrderIncomeIntoCashBook = DB::table('cash_book_tb')->insert($getCashBookInfo);

			return redirect('/head_quater/income_cashbook');
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

    /**
     * @param Request $request
     * @param $accoundhead_id
     * @param null $specification_id
     * @return array
     */
	public function getCashbookInfo(Request $request, $accoundhead_id, $specification_id = null)
	{
		$cashBookInfo = [
			'account_head_id' => $accoundhead_id,
			'payment_type' => $request->optionsRadios,
			'income' => (int)$request->amount,
			'description' => $request->description,
			'specification_id' => $specification_id,
		];
		$getRowCountFromCashBook = $this->getRowCountFromCashBook();
		if (sizeof($getRowCountFromCashBook) > 0) {
			$getBalanceAmount = DB::table('cash_book_tb')->latest('id')->first();
			$cashBookInfo['balance'] = (int)$request->amount + $getBalanceAmount->balance;
		} else {
			$cashBookInfo['balance'] = $request->amount + 0;
		}
		return $cashBookInfo;
	}


    /**
     * Get Row Count Balance For CashBook and Check balance amount
     * @return \Illuminate\Support\Collection
     */
	public function getRowCountFromCashBook()
	{
		$rowCounts = DB::table('cash_book_tb')->get();
		return $rowCounts;
	}

    /**
     * @return \Illuminate\Support\Collection
     */
	public function getAllInvestor()
	{
		$investors = DB::table('invester_tb')->orderby('created_at', 'desc')->where('delete_flag', 0)->get();
		return $investors;
	}

    /**
     * @return \Illuminate\Support\Collection
     */
	public function getAllProject()
	{
		$projects = DB::table('project_tb')->orderby('created_at', 'desc')->where('delete_flag', 0)->get();
		return $projects;
	}

    /**
     * @return \Illuminate\Support\Collection
     */
	public function getAllBank()
	{
		$banks = DB::table('bank_tb')->orderby('created_at', 'desc')->where('delete_flag', 0)->get();
		return $banks;
	}

    /**
     * @return \Illuminate\Support\Collection
     */
	public function getAllPaymentOrder()
	{
		$payment_orders = DB::table('payment_order_tb')->orderby('created_at', 'desc')->where('delete_flag', 0)->get();
		return $payment_orders;
	}

    /**
     * @return \Illuminate\Support\Collection
     */
	public function getAllPurchaseGuarantee()
	{
		$purchase_guarantees = DB::table('purchase_guarantee_tb')->orderby('created_at', 'desc')->where('delete_flag', 0)->get();
		return $purchase_guarantees;
	}

    /**
     * @param $investor_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function getAllInvestorIncomeById($investor_id)
	{
        $totalBalance=0;
		$investorDetail = DB::table('invester_detail_tb')->orderby('created_at', 'desc')
			->where('delete_flag', 0)
			->where('investor_id', $investor_id)
			->get();

		$countInvestorDetail = sizeof($investorDetail);

		if ($countInvestorDetail > 0) {

		    if (!empty($this->calculateTotalBalance($investorDetail))) {
                $totalBalance = $this->calculateTotalBalance($investorDetail);
            }
		}
		return view('head_quater.invester_detail', compact('investorDetail', 'totalBalance'));
	}

    /**
     * @param $project_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function getAllProjectIncomeById($project_id)
	{

		$projectDetail = DB::table('project_detail_tb')->orderby('created_at', 'desc')
			->where('delete_flag', 0)
			->where('project_id', $project_id)
			->get();

		$countProjectDetail = sizeof($projectDetail);

		if ($countProjectDetail > 0) {
			$totalBalance = $this->calculateTotalBalance($projectDetail);
		}

		return view('head_quater.project_detail', compact('projectDetail', 'totalBalance'));
	}

    /**
     * @param $bank_detail_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function getAllBankIncomeById($bank_detail_id)
	{

		$loanDetail = DB::table('loan_detail_tb')->orderby('created_at', 'desc')
			->where('delete_flag', 0)
			->where('bank_detail_id', $bank_detail_id)
			->get();

		$countLoanDetail = sizeof($loanDetail);

		if ($countLoanDetail > 0) {

			$totalBalance = 0;
			foreach ($loanDetail as $data) {
				$totalBalance += $data->loan_amount;
			}
		}
		return view('head_quater.loan_detail', compact('loanDetail', 'totalBalance'));
	}

    /**
     * @param $payment_detail_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function getAllPaymentOrderIncomeById($payment_detail_id)
	{

		$paymentOrderDetail = DB::table('payment_order_detail_tb')->orderby('created_at', 'desc')
			->where('delete_flag', 0)
			->where('payment_order_id', $payment_detail_id)
			->get();

		$countPaymentOrderDetail = sizeof($paymentOrderDetail);

		if ($countPaymentOrderDetail > 0) {

			$totalBalance = 0;
			foreach ($paymentOrderDetail as $data) {
				$totalBalance += $data->receive_amount;
			}
		}
		return view('head_quater.payment_order_detail', compact('paymentOrderDetail', 'totalBalance'));
	}

    /**
     * @param $purchase_guarantee_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function getAllPurchaseGuaranteeIncomeById($purchase_guarantee_id)
	{

		$purchaseGuaranteeDetail = DB::table('purchase_guarantee_detail_tb')->orderby('created_at', 'desc')
			->where('delete_flag', 0)
			->where('purchase_guarantee_id', $purchase_guarantee_id)
			->get();

		$countPurchaseGuaranteeDetail = sizeof($purchaseGuaranteeDetail);

		if ($countPurchaseGuaranteeDetail > 0) {

			$totalBalance = 0;
			foreach ($purchaseGuaranteeDetail as $data) {
				$totalBalance += $data->receive_amount;
			}
		}
		return view('head_quater.purchase_guarantee_detail', compact('purchaseGuaranteeDetail', 'totalBalance'));
	}

    /**
     * @param $total_amount
     * @return int
     */
	public function calculateTotalBalance($total_amount)
	{
		$totalBalance = 0;
		foreach ($total_amount as $data) {
			$totalBalance += $data->amount;
		}
		return $totalBalance;
	}

    /**
     * @param $investor_id
     * @param $investor_detail_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function EditInvestorIncomeById($investor_id,$investor_detail_id)
	{
		$investorDetailId = DB::table('invester_detail_tb')
			->where('investor_detail_id', $investor_detail_id)
			->first();
		return view('head_quater.invester_detail_edit', compact('investorDetailId','investor_id'));
	}

    /**
     * @param $invester_id
     * @param $investor_detail_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
	public function UpdateInvestorIncomeById($invester_id,$investor_detail_id)
	{
        $invester_detail = DB::table('invester_detail_tb')->select('amount','account_head_id','description','investor_detail_id')->where('delete_flag',0)->where('investor_detail_id',$investor_detail_id)->first();

        $updateInvestorDetail = $this->updateTransactionbyId($investor_detail_id,'invester_detail_tb','investor_detail_id');
        if($updateInvestorDetail) {
            $getUpdateAmount = DB::table('invester_detail_tb')
                                ->select('amount')
                                ->where('investor_detail_id',$investor_detail_id)
                                ->where('delete_flag',0)->first();

            $getTotalIncomeamountById = DB::table('investor_income_tb')->select('total_income_balance')->where('delete_flag',0)->where('investor_id',$invester_id)->first();

            if($getTotalIncomeamountById->total_income_balance > 0)
            {
                $diff = $getUpdateAmount->amount - $invester_detail->amount;

                if($getUpdateAmount->amount > $invester_detail->amount) { // eg. update amount = 7001 is greater than original amount 7000

                    $updateTotalIncome = $getTotalIncomeamountById->total_income_balance + $diff;
                    $change_status = "increase";

                } else {
                    $updateTotalIncome = $getTotalIncomeamountById->total_income_balance + $diff; //  Out put of $diff value come with "-" sign ( eg. -1)  that why we should add "+" operator
                    $change_status = "decrease";
                }
                DB::beginTransaction();
                $updateTotalIncomeResult = DB::table('investor_income_tb')->where('investor_id', $invester_id)->update(['total_income_balance' => $updateTotalIncome]);

                if ($updateTotalIncomeResult == 1) {
                    try {
                        /* Income Update Amount In CashBook */
                        $updateAmountInCashbook =  DB::table('cash_book_tb')->where('deleted_flag',0)
                                                    ->where('investor_income_detail_id', $investor_detail_id)
                                                    ->update(['income' => $getUpdateAmount->amount,'is_edit' => 1 ]);

                        if ($updateAmountInCashbook) {
                            /* Add Record Histories into record table*/
                            DB::table('record_histroies_tb')->insert(['invester_detail_id' => $investor_detail_id,
                                'account_head_type' => $invester_detail->account_head_id,
                                'transaction_update_amount' => $getUpdateAmount->amount,
                                'transaction_original_amount' => $invester_detail->amount,
                                'change_status' => $change_status,
                                'diff_amount' => $diff,
                                'remark' => "I have to changed transaction from ".$invester_detail->amount." Kyats to ".$getUpdateAmount->amount ." Kyats . Because I have to wrong filling into investor income",
                                'invester_detail_id' => $invester_detail->investor_detail_id ,
                            ]);
                        }
                        DB::commit();
                    }catch (Exception $e) {
                        DB::rollBack();
                        return $e->getMessage();
                    }
                }
            }
        }
        return redirect("/head_quater/invester_detail/$invester_id");
	}

    /**
     * @param $project_id
     * @param $project_detail_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function EditProjectIncomeById($project_id,$project_detail_id){
        $projectDetailId = DB::table('project_detail_tb')
            ->where('project_detail_id', $project_detail_id)
            ->first();
        return view('head_quater.project_detail_edit', compact('projectDetailId','project_id'));
    }

    /**
     * @param $project_id
     * @param $project_detail_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
	public function UpdateProjectIncomeById($project_id,$project_detail_id){
        $project_detail = DB::table('project_detail_tb')->select('amount','account_head_id','project_id')->where('delete_flag',0)->where('project_detail_id',$project_detail_id)->first();
        $project_name = DB::table('project_tb')->select('name')->where('id',$project_detail->project_id)->where('delete_flag',0)->get();
        $project_name =  $project_name[0]->name;

        $updateProjectDetail = $this->updateTransactionbyId($project_detail_id,'project_detail_tb','project_detail_id');
        if($updateProjectDetail) {
            $getUpdateAmount = DB::table('project_detail_tb')
                ->select('amount')
                ->where('project_detail_id',$project_detail_id)
                ->where('delete_flag',0)->first();

            $getTotalIncomeamountById = DB::table('project_income_tb')->select('total_income_balance')->where('delete_flag',0)->where('project_id',$project_id)->first();
            try {
                DB::beginTransaction();
                if ($getTotalIncomeamountById->total_income_balance > 0) {
                    $diff = $getUpdateAmount->amount - $project_detail->amount;

                    if ($getUpdateAmount->amount > $project_detail->amount) { // eg. update amount = 7001 is greater than original amount 7000

                        $updateTotalIncome = $getTotalIncomeamountById->total_income_balance + $diff;
                        $change_status = "increase";

                    } else {
                        $updateTotalIncome = $getTotalIncomeamountById->total_income_balance + $diff; //  Out put of $diff value come with "-" sign ( eg. -1)  that why we should add "+" operator
                        $change_status = "decrease";
                    }
                    DB::beginTransaction();

                    $updateTotalIncomeResult = DB::table('project_income_tb')->where('project_id', $project_id)->update(['total_income_balance' => $updateTotalIncome]);

                    if ($updateTotalIncomeResult == 1) {
                        try {
                            /* Income Update Amount In CashBook */
                            $updateAmountInCashbook = DB::table('cash_book_tb')->where('deleted_flag', 0)
                                ->where('project_income_detail_id', $project_detail_id)
                                ->update(['income' => $getUpdateAmount->amount , 'is_edit' => 1]);

                            if ($updateAmountInCashbook) {
                                /* Add Record Histories into record table*/
                                DB::table('record_histroies_tb')->insert(['project_detail_id' => $project_detail_id,
                                    'account_head_type' => $project_detail->account_head_id,
                                    'transaction_update_amount' => $getUpdateAmount->amount,
                                    'transaction_original_amount' => $project_detail->amount,
                                    'change_status' => $change_status,
                                    'diff_amount' => $diff,
                                    'remark' => "I have to changed transaction from " . $project_detail->amount . " Kyats to " . $getUpdateAmount->amount . " Kyats for  " . $project_name . " . Because I have to wrong filling into project income",
                                ]);
                            }
                            DB::commit();
                        } catch (Exception $e) {
                            DB::rollBack();
                            return $e->getMessage();
                        }
                    }
                }
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                return $exception->getMessage();
            }
        }
        return redirect("/head_quater/project_detail/$project_id");
    }

    /**
     * @param $loan_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function EditBankIncomeById($loan_id){
        $loanDetailId = DB::table('loan_detail_tb')->where('id', $loan_id)->first();
        return view('head_quater.loan_detail_edit', compact('loanDetailId'));
//        return view('head_quater.loan_detail_edit', compact('loanDetailId','bank_detail_id'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function DeleteBankIncomeById($id) {
        DB::update('update loan_detail_tb set delete_flag = ?  where id = ?', [1, $id]);
        return redirect('/head_quater/income_cashbook');
	}

    /**
     * @param Request $request
     * @param $loan_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function UpdateBankIncomeById(Request $request,$loan_id){

        $updateRecords = [
            'account_head_type' => $request->accountHead,
            'transaction_update_amount' => $request->amount,
            'change_status' => null,
            'payment_type' => $request->payment_type,
            'remark' => "edited for ".$loan_id ,
        ];

        $transactionOrginalAmount = DB::table('loan_detail_tb')->select('loan_amount')->where('id', $loan_id)->first();
        $originalAmount = $transactionOrginalAmount->loan_amount;

        $updateRecords['transaction_original_amount'] = $originalAmount;
        $updateRecords['bank_income_detail_id'] = $loan_id;


        DB::update('update loan_detail_tb set loan_amount = ?  where id = ?',[$updateRecords['transaction_update_amount'],$loan_id]);

        // Calculate Different Amount and Define Change Status
        $updateAmount = $request->amount;
        $diffAmount = $this->calculateDiffAmount($originalAmount, $updateAmount);
        $updateRecords['diff_amount'] = $diffAmount['diff_amount'];
        $updateRecords['change_status'] = $diffAmount['change_status'];

        // Insert Into record histories
        $insertRecord = DB::table('record_histroies_tb')->insert(['bank_detail_id' => $loan_id,
            'account_head_type' => $updateRecords['account_head_type'],
            'transaction_update_amount' => $updateAmount,
            'transaction_original_amount' => $originalAmount,
            'change_status' => $updateRecords['change_status'],
            'diff_amount' => $updateRecords['diff_amount'],
            'remark' => "I have to changed transaction from ".$originalAmount." Kyats to ".$updateAmount." Kyats . Because I have to wrong filling into bank income",
        ]);

        if ($insertRecord == 1) {
            // Insert Into Cashbook
            DB::table('cash_book_tb')->where('deleted_flag',0)
                ->where('bank_income_detail_id', $loan_id)->where('deleted_flag',0)
                ->update(['income' => $updateAmount, 'description' => $updateRecords['remark']]);
        }
        return redirect("/head_quater/income_cashbook/bank_loan");
	}

    /**
     * @param $originalAmount
     * @param $updateAmount
     * @return array
     */
    public function calculateDiffAmount($originalAmount,$updateAmount) {
        $updateRecords= [];
        if ($updateAmount > $originalAmount) {
            $updateRecords['diff_amount'] = $updateAmount - $originalAmount;
            $updateRecords['change_status'] = "increase";
        } else if ($originalAmount > $updateAmount ){
            $updateRecords['diff_amount'] = $originalAmount - $updateAmount;
            $updateRecords['change_status'] = "decrease";
        } else {
            $updateRecords['diff_amount'] = 0;
            $updateRecords['change_status'] = null;
        }
        return $updateRecords;
    }

    /**
     * @param $id
     * @param $tablename
     * @param $column_name
     * @return int
     */
    public function updateTransactionbyId($id,$tablename,$column_name)
    {
        return DB::table($tablename)->where($column_name, $id)->update(['amount' => request()->amount]);
    }

    /**
     * Tinder Register
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function storeTinderRegister(Request $request) {
        $inputs = [
            'register_name' => $request->register_name,
            'register_type' => $request->register_type, // 0 define PO and 1 define PG
            'register_amount' => $request->register_amount,
            'payment_type' => $request->payment_type,
            'register_date' => $request->register_date,
            'description' => $request->description,
            'account_head' => $request->account_head,
        ];
        try {
            DB::beginTransaction();
            $insertTable = DB::table('popg_tb')->insert($inputs);
            $getLastInserId = DB::getPdo()->lastInsertId();
            if($insertTable) {
                $lasCashBookData = DB::table('cash_book_tb')->get()->last();
                $totalBalance = $lasCashBookData->balance;
                $cashBookDatas = [
                    'account_head_id' => $inputs['account_head'],
                    'payment_type' => $inputs['payment_type'] ,
                    'description' => $inputs['description'],
                ];
                if($inputs['register_type'] == 0) {
                    $cashBookDatas['po_expense_id'] = $getLastInserId;
                } else {
                    $cashBookDatas['pg_expense_id'] = $getLastInserId;
                }
                $cashBookDatas['expend'] =  $inputs['register_amount'];
                $cashBookDatas['balance'] = $totalBalance - $inputs['register_amount'];
                DB::table('cash_book_tb')->insert($cashBookDatas);
                DB::commit();

                return redirect('/head_quater/income_cashbook/po_pg');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function paybackTinder(Request $request, $id) {
        $input = [
            'register_type' => $request->register_type,
            'payback_amount' => $request->payback_amount,
        ];
        try {
            DB::beginTransaction();
            $checkId = DB::table('popg_tb')->select('id','payback_amount')->where("id", $id)->first();
            $update_payback_amount = $checkId->payback_amount + $input['payback_amount'];
            if ($checkId != null) {
                $updateAmount = DB::update('update popg_tb set payback_amount = ?  where id = ?', [$update_payback_amount, $id]);
                if($updateAmount) {
                    DB::table('popg_detail_tb')->insert([
                        'popg_id' => $id,
                        'payback_date' => $request->register_date,
                        'payback_amount' => $request->payback_amount,
                        'description' => $request->description,
                    ]);

                    $lasCashBookData = DB::table('cash_book_tb')->get()->last();
                    $totalBalance = $lasCashBookData->balance;
                    $cashBookDatas = [
                        'account_head_id' => $request->account_head,
//                        'payment_order_detail_id'=> $id,
                        'payment_type' => $request->payment_type,
                        'description' => $request->description,
                    ];
                    if ($input['register_type'] == 0) {
                        $cashBookDatas['po_income_id'] = $id;
                    } else {
                        $cashBookDatas['pg_income_id'] = $id;
                    }

                    $cashBookDatas['income'] = $input['payback_amount'] ;
                    $cashBookDatas['balance'] = $totalBalance + $input['payback_amount'];
                    DB::table('cash_book_tb')->insert($cashBookDatas);
                }
            }
            DB::commit();
            return redirect('/head_quater/income_cashbook/po_pg');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTinderRegisterById($id){
        $getData = DB::table('popg_tb')->select("*")->where('id',$id)->where('delete_flag',0)->get();
        return view('tinder.payback_tinder',compact('getData'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editTinderRegisterById($id) {

        $getData = DB::table('popg_tb')
            ->join('account_head_tb','account_head_tb.id','=','popg_tb.account_head')
            ->select('popg_tb.*','account_head_tb.account_head_type')
            ->where('popg_tb.id',$id)
            ->where('popg_tb.delete_flag',0)
            ->get();
        return view('tinder.edit_payback_tinder_detail',compact('getData'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function updateTinderRegisterById(Request $request,$id) {

        $inputs = [
            'register_name' => $request->register_name,
            'register_type' => $request->register_type, // 0 define PO and 1 define PG
            'register_amount' => $request->register_amount,
            'payment_type' => $request->payment_type,
            'register_date' => $request->register_date,
            'description' => $request->description,
            'account_head' => $request->account_head,
        ];

        try {
            DB::beginTransaction();
                $updateData = DB::table('popg_tb')->where('id',$id)->update($inputs);

                if($updateData) {
                    //change value into cashbook
                    if($inputs['register_type'] == 0) {
                        $detail_id = "po_detail_id";
                        $originalTransaction = DB::table('cash_book_tb')->select("expend")->where('po_expense_id',$id)->get();
                        $originalTransaction = $originalTransaction[0]->expend;
                        $updateTransaction = $inputs['register_amount'];
                        if($updateTransaction > $originalTransaction) {
                            $changeStatus = "increase";
                        } else {
                            $changeStatus = "decrease";
                        }
                        DB::update('update cash_book_tb set expend = ?  where po_expense_id = ?', [$inputs['register_amount'], $id]);
                    } else {
                        $detail_id = "pg_detail_id";
                        $originalTransaction = DB::table('cash_book_tb')->select("expend")->where('pg_expense_id',$id)->get();
                        $originalTransaction = $originalTransaction[0]->expend;
                        $updateTransaction = $inputs['register_amount'];
                        if($updateTransaction > $originalTransaction) {
                            $changeStatus = "increase";
                        } else {
                            $changeStatus = "decrease";
                        }
                        DB::update('update cash_book_tb set expend = ?  where pg_expense_id = ?', [$inputs['register_amount'], $id]);
                    }

                    DB::table('record_histroies_tb')->insert([
                        $detail_id => $id,
                        'account_head_type' => $request->account_head,
                        'transaction_update_amount' => $updateTransaction,
                        'transaction_original_amount' => $originalTransaction,
                        'change_status' => $changeStatus,
                        'diff_amount' => $updateTransaction - $originalTransaction,
                        'remark' => "I have to changed transaction from ". $originalTransaction. " Kyats to ". $updateTransaction ." Kyats . Because I have to wrong filling into po/pg.",
                    ]);
                }
            DB::commit();
                return redirect('/head_quater/income_cashbook/po_pg');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAllAccountHead(){
        return DB::table('account_head_tb')->select('*')->where('delete_flag',0)->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllDetailPaybackTinder($id){

        $getAllData =  DB::table('popg_detail_tb')
            ->select("*")
            ->where('popg_id', $id)
            ->get();
        return view('tinder.payback_tinder_detail',compact('getAllData'));
    }

    public function incomeCashbookProject()
    {
        $getAllInvestorIncome = DB::table('investor_income_tb')
			->join('invester_tb', 'invester_tb.id', '=', 'investor_income_tb.investor_id')
			->select('investor_income_tb.*', 'invester_tb.name')
			->where('investor_income_tb.delete_flag', 0)
			->get();

		$getAllProjectIncome = DB::table('project_income_tb')
			->join('project_tb', 'project_tb.id', '=', 'project_income_tb.project_id')
			->select('project_income_tb.*', 'project_tb.name')
			->where('project_income_tb.delete_flag', 0)
			->paginate(15);

		$getAllBankIncome = DB::table('bank_detail_tb')
			->join('bank_tb', 'bank_tb.id', '=', 'bank_detail_tb.bank_id')
			->select('bank_detail_tb.*', 'bank_tb.name')
			->where('bank_detail_tb.delete_flag', 0)
			->get();
        $loanDetail = DB::table('loan_detail_tb')->orderby('created_at', 'desc')
            ->where('delete_flag', 0)
            ->get();


		$getAllPaymentOrderIncome = DB::table('payment_order_detail_tb')
			->join('payment_order_tb', 'payment_order_tb.id', '=', 'payment_order_detail_tb.payment_order_id')
			->select('payment_order_detail_tb.*', 'payment_order_tb.name')
			->where('payment_order_detail_tb.delete_flag', 0)
			->get();

		$getAllPurchaseGauranteeIncome = DB::table('purchase_guarantee_income_tb')
			->join('purchase_guarantee_tb', 'purchase_guarantee_tb.id', '=', 'purchase_guarantee_income_tb.purchase_guarantee_id')
			->select('purchase_guarantee_income_tb.*', 'purchase_guarantee_tb.name')
			->where('purchase_guarantee_income_tb.delete_flag', 0)
			->get();

		$getAllTinderRegisteration = DB::table('popg_tb')
            ->join('account_head_tb','account_head_tb.id','=','popg_tb.account_head')
            ->select('popg_tb.*','account_head_tb.account_head_type')->where('popg_tb.delete_flag',0)
            ->get();
		return view('head_quater.income_cashbook_project', compact('getAllInvestorIncome', 'getAllProjectIncome', 'getAllBankIncome', 'getAllPaymentOrderIncome', 'getAllPurchaseGauranteeIncome','loanDetail','getAllTinderRegisteration'));
    }

    public function incomeCashbookProjectCreate()
    {
        $investors = $this->getAllInvestor();
		$projects = $this->getAllProject();
		$banks = $this->getAllBank();
        $accountHead = $this->getAllAccountHead();
		return view('head_quater.income_cashbook_project_create', compact('investors', 'projects', 'banks', 'paymentOrders', 'purchaseGuarantees', 'accountHead'));
    }

    public function incomeBankLoan()
    {
        $getAllInvestorIncome = DB::table('investor_income_tb')
			->join('invester_tb', 'invester_tb.id', '=', 'investor_income_tb.investor_id')
			->select('investor_income_tb.*', 'invester_tb.name')
			->where('investor_income_tb.delete_flag', 0)
			->get();

		$getAllProjectIncome = DB::table('project_income_tb')
			->join('project_tb', 'project_tb.id', '=', 'project_income_tb.project_id')
			->select('project_income_tb.*', 'project_tb.name')
			->where('project_income_tb.delete_flag', 0)
			->get();

		$getAllBankIncome = DB::table('bank_detail_tb')
			->join('bank_tb', 'bank_tb.id', '=', 'bank_detail_tb.bank_id')
			->select('bank_detail_tb.*', 'bank_tb.name')
			->where('bank_detail_tb.delete_flag', 0)
			->get();
        $loanDetail = DB::table('loan_detail_tb')->orderby('created_at', 'desc')
            ->where('delete_flag', 0)
            ->paginate(15);


		$getAllPaymentOrderIncome = DB::table('payment_order_detail_tb')
			->join('payment_order_tb', 'payment_order_tb.id', '=', 'payment_order_detail_tb.payment_order_id')
			->select('payment_order_detail_tb.*', 'payment_order_tb.name')
			->where('payment_order_detail_tb.delete_flag', 0)
			->get();

		$getAllPurchaseGauranteeIncome = DB::table('purchase_guarantee_income_tb')
			->join('purchase_guarantee_tb', 'purchase_guarantee_tb.id', '=', 'purchase_guarantee_income_tb.purchase_guarantee_id')
			->select('purchase_guarantee_income_tb.*', 'purchase_guarantee_tb.name')
			->where('purchase_guarantee_income_tb.delete_flag', 0)
			->get();

		$getAllTinderRegisteration = DB::table('popg_tb')
            ->join('account_head_tb','account_head_tb.id','=','popg_tb.account_head')
            ->select('popg_tb.*','account_head_tb.account_head_type')->where('popg_tb.delete_flag',0)
            ->get();
		return view('head_quater.income_bank_loan', compact('getAllInvestorIncome', 'getAllProjectIncome', 'getAllBankIncome', 'getAllPaymentOrderIncome', 'getAllPurchaseGauranteeIncome','loanDetail','getAllTinderRegisteration'));
    }

    public function incomeCashbookBankLoanCreate()
    {
        $investors = $this->getAllInvestor();
		$projects = $this->getAllProject();
		$banks = $this->getAllBank();
        $accountHead = $this->getAllAccountHead();
		return view('head_quater.income_cashbook_bankloan_create', compact('investors', 'projects', 'banks', 'paymentOrders', 'purchaseGuarantees', 'accountHead'));
    }

    public function incomePoPG()
    {
        $getAllInvestorIncome = DB::table('investor_income_tb')
			->join('invester_tb', 'invester_tb.id', '=', 'investor_income_tb.investor_id')
			->select('investor_income_tb.*', 'invester_tb.name')
			->where('investor_income_tb.delete_flag', 0)
			->get();

		$getAllProjectIncome = DB::table('project_income_tb')
			->join('project_tb', 'project_tb.id', '=', 'project_income_tb.project_id')
			->select('project_income_tb.*', 'project_tb.name')
			->where('project_income_tb.delete_flag', 0)
			->get();

		$getAllBankIncome = DB::table('bank_detail_tb')
			->join('bank_tb', 'bank_tb.id', '=', 'bank_detail_tb.bank_id')
			->select('bank_detail_tb.*', 'bank_tb.name')
			->where('bank_detail_tb.delete_flag', 0)
			->get();
        $loanDetail = DB::table('loan_detail_tb')->orderby('created_at', 'desc')
            ->where('delete_flag', 0)
            ->get();


		$getAllPaymentOrderIncome = DB::table('payment_order_detail_tb')
			->join('payment_order_tb', 'payment_order_tb.id', '=', 'payment_order_detail_tb.payment_order_id')
			->select('payment_order_detail_tb.*', 'payment_order_tb.name')
			->where('payment_order_detail_tb.delete_flag', 0)
			->get();

		$getAllPurchaseGauranteeIncome = DB::table('purchase_guarantee_income_tb')
			->join('purchase_guarantee_tb', 'purchase_guarantee_tb.id', '=', 'purchase_guarantee_income_tb.purchase_guarantee_id')
			->select('purchase_guarantee_income_tb.*', 'purchase_guarantee_tb.name')
			->where('purchase_guarantee_income_tb.delete_flag', 0)
			->get();

		$getAllTinderRegisteration = DB::table('popg_tb')
            ->join('account_head_tb','account_head_tb.id','=','popg_tb.account_head')
            ->select('popg_tb.*','account_head_tb.account_head_type')->where('popg_tb.delete_flag',0)
            ->paginate(15);
		return view('head_quater.income_po_pg', compact('getAllInvestorIncome', 'getAllProjectIncome', 'getAllBankIncome', 'getAllPaymentOrderIncome', 'getAllPurchaseGauranteeIncome','loanDetail','getAllTinderRegisteration'));
    }

    public function incomeCashbookPoPgreate()
    {
        $investors = $this->getAllInvestor();
		$projects = $this->getAllProject();
		$banks = $this->getAllBank();
        $accountHead = $this->getAllAccountHead();
		return view('head_quater.income_cashbook_po_pg_create', compact('investors', 'projects', 'banks', 'paymentOrders', 'purchaseGuarantees', 'accountHead'));
    }
}
