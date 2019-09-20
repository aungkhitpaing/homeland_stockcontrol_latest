<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeadQuaterIncomeController extends Controller
{

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


		$getAllPaymentOrderIncome = DB::table('payment_order_income_tb')
			->join('payment_order_tb', 'payment_order_tb.id', '=', 'payment_order_income_tb.payment_order_id')
			->select('payment_order_income_tb.*', 'payment_order_tb.name')
			->where('payment_order_income_tb.delete_flag', 0)
			->get();

		$getAllPurchaseGauranteeIncome = DB::table('purchase_guarantee_income_tb')
			->join('purchase_guarantee_tb', 'purchase_guarantee_tb.id', '=', 'purchase_guarantee_income_tb.purchase_guarantee_id')
			->select('purchase_guarantee_income_tb.*', 'purchase_guarantee_tb.name')
			->where('purchase_guarantee_income_tb.delete_flag', 0)
			->get();

		return view('head_quater.income_cashbook', compact('getAllInvestorIncome', 'getAllProjectIncome', 'getAllBankIncome', 'getAllPaymentOrderIncome', 'getAllPurchaseGauranteeIncome'));
	}


	/**
	 * create
	 *
	 * @return Response
	 */

	public function create()
	{
		$investors = $this->getAllInvestor();
		$projects = $this->getAllProject();
		$banks = $this->getAllBank();
		$paymentOrders = $this->getAllPaymentOrder();
		$purchaseGuarantees = $this->getAllPurchaseGuarantee();
		return view('head_quater.add_income', compact('investors', 'projects', 'banks', 'paymentOrders', 'purchaseGuarantees'));
	}

	/**
	 * createInvestorIncome
	 *
	 * @return Response
	 */

	public function storeInvestorIncome(Request $request)
	{

		$investorIncomeReq = [
			'investor_id' => $request->investor,
			'payment_type' => $request->optionsRadios,
			'amount' => $request->amount,
			'description' => $request->description
		];

		$specification_id = $request->investor;

		$getCashbookInfo = $this->getCashbookInfo($request, $request->accountHead, $specification_id);

		try {

			$investorDetail = DB::table('invester_detail_tb')->orderby('created_at', 'desc')
				->where('delete_flag', 0)
				->where('investor_id', $request->investor)
				->get();

			if (sizeof($investorDetail) == 0) {
				$insertInvestorIncome = DB::table('investor_income_tb')->insert([
					'investor_id' => $request->investor,
					'total_income_balance' => $request->amount,
				]);
			} else {
				$totalBalance = DB::table('investor_income_tb')->where('investor_id', $request->investor)->first();
				$updateTotalBalance = DB::table('investor_income_tb')->where('investor_id', $request->investor)->update(['total_income_balance' => $totalBalance->total_income_balance + $request->amount]);
			}

			$insertInvestorIncome = DB::table('invester_detail_tb')->insert($investorIncomeReq);

			$insertInvestorIncomeIntoCashBook = DB::table('cash_book_tb')->insert($getCashbookInfo);

			return redirect('/head_quater/income_cashbook');
		} catch (Exception $e) {

			return $e->getMessage();
		}
	}

	/**
	 * storeProjectIncome
	 *
	 * @return Response
	 */
	public function storeProjectIncome(Request $request)
	{

		$projectIncomeReq = [
			'project_id' => $request->project,
			'payment_type' => $request->optionsRadios,
			'transfer_type' => 'income',
			'amount' => $request->amount,
			'description' => $request->description
		];

		$specification_id = $request->project;

		$getCashBookInfo = $this->getCashBookInfo($request, $request->accountHead, $specification_id);

		try {

			// check row count of project detail 
			$projectDetail = DB::table('project_detail_tb')->orderby('created_at', 'desc')
				->where('delete_flag', 0)
				->where('project_id', $request->project)
				->get();

			if (sizeof($projectDetail) == 0) {
				$insertProjectIncome = DB::table('project_income_tb')->insert([
					'project_id' => $request->project,
					'total_income_balance' => $request->amount,
				]);
			} else {

				// calculate total balance
				$totalBalance = DB::table('project_income_tb')->where('project_id', $request->project)->first();
				$updateTotalBalance = DB::table('project_income_tb')->where('project_id', $request->project)->update(['total_income_balance' => $totalBalance->total_income_balance + $request->amount]);
			}
			$insertProjectIncome = DB::table('project_detail_tb')->insert($projectIncomeReq);
			$insertInvestorIncomeIntoCashBook = DB::table('cash_book_tb')->insert($getCashBookInfo);

			return redirect('/head_quater/income_cashbook');
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * storeBankIncome
	 *
	 * @return Response
	 */
	public function storeBankIncome(Request $request)
	{

		$bankLoanReq = [
			'bank_detail_id' => $request->bank,
			'loan_amount' => $request->amount,
			'loan_date' => $request->loan_date,
			'payment_type' => $request->optionsRadios,
			'description' => $request->description,
		];

		$specification_id = $request->bank;

		$getCashBookInfo = $this->getCashBookInfo($request, $request->accountHead, $specification_id);

		try {

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
			$insertBankIncomeIntoCashBook = DB::table('cash_book_tb')->insert($getCashBookInfo);

			return redirect('/head_quater/income_cashbook');
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * storeBankIncome
	 *
	 * @return Response
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

			// check row count of project detail 
			$paymentOrderDetail = DB::table('payment_order_detail_tb')->orderby('created_at', 'desc')
				->where('delete_flag', 0)
				->where('payment_order_id', $request->paymentorder)
				->get();

			if (sizeof($paymentOrderDetail) == 0) {
				$insertProjectIncome = DB::table('payment_order_income_tb')->insert([
					'payment_order_id' => $request->paymentorder,
					'total_income_balance' => $request->amount,
					'with_draw' => $request->receive_date,
					'description' => $request->description,
				]);
			} else {

				// calculate total balance
				$totalBalance = DB::table('payment_order_income_tb')->where('payment_order_id', $request->paymentorder)->first();
				$updateTotalBalance = DB::table('payment_order_income_tb')->where('payment_order_id', $request->paymentorder)->update(['total_income_balance' => $totalBalance->total_income_balance + $request->amount]);
			}
			$insertPaymentOrderIncome = DB::table('payment_order_detail_tb')->insert($POIncomeReq);
			$insertPaymentOrderIncomeIntoCashBook = DB::table('cash_book_tb')->insert($getCashBookInfo);

			return redirect('/head_quater/income_cashbook');
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

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
	 * getCashBook Information
	 *
	 * @return Response
	 */
	public function getCashbookInfo(Request $request, $accoundhead_id, $specification_id = null)
	{

		$cashBookInfo = [
			'account_head_id' => $accoundhead_id,
			'payment_type' => $request->optionsRadios,
			'income' => (int)$request->amount,
			'description' => $request->description,
			'specification_id' => $specification_id
		];

		// if($accoundhead_id == 1) {

		// 	$cashBookInfo['specification_id'] = $request->investor;

		// } elseif ($accoundhead_id == 2) {

		// 	$cashBookInfo['specification_id'] = $request->project;

		// } elseif ($accoundhead_id == 3) {

		// 	$cashBookInfo['specification_id'] = $request->bank;
		// 	$cashBookInfo['payment_type'] = 'Bank';

		// } elseif ($accoundhead_id == 4) {

		// 	$cashBookInfo['specification_id'] = $request->paymentorder;

		// } elseif ($accoundhead_id == 5) {

		// 	$cashBookInfo['specification_id'] = $request->purchaseguarantee;
		// }

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
	 *
	 * @return Response
	 */

	public function getRowCountFromCashBook()
	{
		$rowCounts = DB::table('cash_book_tb')->get();
		return $rowCounts;
	}

	/**
	 * get all investor Income
	 *
	 * @return Response
	 */

	public function getAllInvestor()
	{
		$investors = DB::table('invester_tb')->orderby('created_at', 'desc')->where('delete_flag', 0)->get();
		return $investors;
	}

	/**
	 * get all investor Income
	 *
	 * @return Response
	 */

	public function getAllProject()
	{
		$projects = DB::table('project_tb')->orderby('created_at', 'desc')->where('delete_flag', 0)->get();
		return $projects;
	}

	/**
	 * get all bank Income
	 *
	 * @return Response
	 */

	public function getAllBank()
	{
		$banks = DB::table('bank_tb')->orderby('created_at', 'desc')->where('delete_flag', 0)->get();
		return $banks;
	}


	public function getAllPaymentOrder()
	{
		$payment_orders = DB::table('payment_order_tb')->orderby('created_at', 'desc')->where('delete_flag', 0)->get();
		return $payment_orders;
	}


	public function getAllPurchaseGuarantee()
	{
		$purchase_guarantees = DB::table('purchase_guarantee_tb')->orderby('created_at', 'desc')->where('delete_flag', 0)->get();
		return $purchase_guarantees;
	}
	/**
	 * get all investor income by Id
	 *
	 * @return Response
	 */

	public function getAllInvestorIncomeById($investor_id)
	{
		$investorDetail = DB::table('invester_detail_tb')->orderby('created_at', 'desc')
			->where('delete_flag', 0)
			->where('investor_id', $investor_id)
			->get();

		$countInvestorDetail = sizeof($investorDetail);

		if ($countInvestorDetail > 0) {
			$totalBalance = $this->calculateTotalBalance($investorDetail);
		}
		return view('head_quater.invester_detail', compact('investorDetail', 'totalBalance'));
	}


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
	 * calculation of total balance
	 *
	 * @return Response
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
	 * Edit Investor Income Amount
	 *
	 * @param $investor_id
	 * @return void
	 */
	public function EditInvestorIncomeById($investor_id)
	{
		$investorDetail = DB::table('invester_detail_tb')
			->where('investor_id', $investor_id)
			->first();

		return view('head_quater.invester_detail_edit', compact('investorDetail'));
	}

	/**
	 * Update Investor Income Amount
	 *
	 * @param $investor_id
	 * @return void
	 */
	public function UpdateInvestorIncomeById($investor_id)
	{
		$investorDetail = DB::table('invester_detail_tb')
			->where('investor_id', $investor_id)
			->update(['amount' => request()->amount]);

		return redirect('/head_quater/invester_detail/' . $investor_id);
	}
}
