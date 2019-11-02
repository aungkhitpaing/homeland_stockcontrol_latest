<?php

namespace App\Http\Controllers;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
/**
 * Class Head Quater ExpandController
 * Author : Aung Khit Paing
 * @package App\Http\Controllers
 */
class HeadQuaterExpandController extends Controller
{

	public function index() {

	    $getAllOfficeExpense = $this->getAllOfficeExpense();

	    $getTotalOfficeExpense = 0;
        foreach ($getAllOfficeExpense as $data) {
            $getTotalOfficeExpense += $data->amount;
        }

	    $getAllProjectExpense = $this->getAllProjectExpense();
        $getAllBankExpense = $this->getAllBankExpense();
        return view('head_quater.expend_cashbook',compact('getAllOfficeExpense','getTotalOfficeExpense','getAllProjectExpense','getAllBankExpense'));
    }

    public function create() {
        $accountHeads = $this->getAllAccountHead();
        $getAllExpenseCategories = $this->showExpenseCategory();
        $getAllProjects = $this->getAllProject();
        $banks = $this->getAllBank();
        $getAllLoanTransfer = $this->getAllLoanTransfer();
        $getAllPaymentOrder = DB::table('payment_order_tb')->select('id','name')->where('delete_flag',0)->get();
        return view ('head_quater.add_expend', compact('accountHeads','getAllExpenseCategories','getAllProjects','banks','getAllLoanTransfer','getAllPaymentOrder'));
    }

    public function createBankLoan($id) {
        $accountHeads = $this->getAllAccountHead();
        $getBankLoanTransfer = DB::table('loan_detail_tb')
            ->join('bank_tb','bank_tb.id','=','loan_detail_tb.bank_detail_id')
            ->select('loan_detail_tb.*','bank_tb.name')
            ->where('loan_detail_tb.id',$id)
            ->where('loan_detail_tb.delete_flag',0)->get();
        $banks = $this->getAllBank();
        return view ('head_quater.add_bank_expend', compact('accountHeads','getBankLoanTransfer','banks'));
    }

    public function storeDailyExpend(Request $request) {
        try {
                DB::transaction(function() use ($request){
                    $inputs = [
                        'expense_category' => $request->dailyexpend,
                        'payment_type' => $request->optionsRadios,
                        'amount' => $request->amount,
                        'description' => $request->description,
                        'account_head_id' => $request->accountHead,
                    ];
                    $getCashbookInfo = $this->getCashbookInfo($request,$request->accountHead);

                    DB::table('office_expense_detail_tb')->insert($inputs);
                    $getCashbookInfo['office_expense_detail_id'] = DB::getPdo()->lastInsertId();

                    DB::table('cash_book_tb')->insert($getCashbookInfo);
            });
    		return redirect('/head_quater/alltransaction');
    	} catch (Exception $e) {
    		return $e->getMessage();
    	}
    }

    public function storeProjectExpend(Request $request) {

        $projectExpenseReq = [
        
            'project_id' => $request->project,
            'payment_type' => $request->optionsRadios,
            'transfer_type' => 'expense',
            'amount' => $request->amount,
            'description' => $request->description,
            'account_head_id' => $request->accountHead,
        ];

        $specification_id = $request->project;
        $getCashbookInfo = $this->getCashbookInfo($request,$request->accountHead,$specification_id);

        DB::beginTransaction();
        try {
            // check row count of  detail 
            $projectExpenseDetail = DB::table('project_expense_detail_tb')->orderby('created_at','desc')
                             ->where('delete_flag',0)
                             ->where('project_id',$request->project)
                             ->get();


            if (sizeof($projectExpenseDetail) == 0 ) {
                DB::table('project_expense_tb')->insert([
                    'project_id' => $request->project,
                    'total_expense_balance' => $request->amount,
                ]);
            } else {
                $totalBalance = DB::table('project_expense_tb')->where('project_id',$request->project)->first();
                DB::table('project_expense_tb')->where('project_id',$request->project)->update(['total_expense_balance' => $totalBalance->total_expense_balance + $request->amount]);
            }

            DB::table('project_expense_detail_tb')->insert($projectExpenseReq);
            $getCashbookInfo['project_expense_detail_id'] = DB::getPdo()->lastInsertId();

            DB::table('cash_book_tb')->insert($getCashbookInfo);
            $siteExpense = [
                'project_id' => $request->project,
                'account_head' => $request->accountHead,
                'description' => $request->description,
                'income' => $request->amount,
            ];
            DB::table('site_cashbook')->insert($siteExpense);
            DB::commit();
            return redirect('/head_quater/alltransaction');

        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();

        }
    }

    public function storeBankExpense(Request $request) {
        $specification_id = $request->loan_transfer_id;
        $getCashBookInfo = $this->getCashBookInfo($request,$request->accountHead,$specification_id);

        try {
            $checkLoanTransferById = DB::table('loan_detail_tb')->orderby('created_at','desc')
                             ->where('delete_flag',0)
                             ->where('id',$request->loan_transfer_id)
                             ->get();
            if(!empty($checkLoanTransferById)) {
                foreach ($checkLoanTransferById as $checkLoanTransfer) {
                    $update_amount = $checkLoanTransfer->payback_amount + $request->amount;    
                }
                $setExpense = DB::update('update loan_detail_tb set payback_amount = ?  where id = ?',[$update_amount,$request->loan_transfer_id]);
                if ($setExpense) {
                    DB::table('bank_expense_tb')->insert([
                        'account_head_type' => $request->accountHead,
                        'loan_transfer_id' => $request->loan_transfer_id,
                        'payment_type' => $request->optionsRadios,
                        'payback_amount' => $request->amount,
                        'description' => $request->description,
                    ]);
                    $getCashBookInfo['bank_expense_detail_id'] = DB::getPdo()->lastInsertId();
                    DB::table('cash_book_tb')->insert($getCashBookInfo);
                    return redirect('/head_quater/income_cashbook/');
                } else {
                    return redirect('/head_quater/add_expend/bank');
                }   
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function storePaymentOrderExpend(Request $request) {
        try {
            $inputs = [
                'po_name_id' => $request->paymentorder,
                'po_register_amount' => $request->amount,
                'payment_type' => $request->optionsRadios,
                'register_date' => $request->register_date,
                'account_head_id' => $request->accountHead,
            ];
            $getCashbookInfo = $this->getCashbookInfo($request,$request->accountHead);

            DB::beginTransaction();
                DB::table('payment_order_detail_tb')->insert([
                    'payment_order_id' => $request->paymentorder,
                    'install_amount' => $request->amount,
                    'install_date' => $request->register_date,
                    'payment_type' => $request->optionsRadios,
                    'description' => $request->description,
                ]);

            DB::table('payment_order_expend_tb')->insert($inputs);
            $getCashbookInfo['payment_order_expense_detail_id'] = DB::getPdo()->lastInsertId();
            DB::table('cash_book_tb')->insert($getCashbookInfo);
            DB::commit();
            return redirect('/head_quater/income_cashbook/');


        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function storePurchaseGuarantee(Request $request) {

    }

    public function getCashbookInfo(Request $request, $accoundhead_id, $specification_id = null) {
    	$cashBookInfo = [
			'account_head_id' => $accoundhead_id,
			'payment_type' => $request->optionsRadios,
			'expend' => (int)$request->amount,
			'description' => $request->description,
            'specification_id' => $specification_id,
		];
    	$getRowCountFromCashBook = DB::table('cash_book_tb')->count();
    	if($getRowCountFromCashBook > 0) {
    		$getBalanceAmount = DB::table('cash_book_tb')->select('balance')->latest('id')->first();
    		$cashBookInfo['balance'] = $getBalanceAmount->balance - (int)$request->amount;
    	} else {
    		$cashBookInfo['balance'] = $request->amount - 0;
    	}
    	return $cashBookInfo;
    }


//  Get All Group

    public function getAllAccountHead() {
        $getAllAccountHead = DB::table('account_head_tb')->where('delete_flag',0)->get();
        return $getAllAccountHead;
    }

    public function getAllOfficeExpense() {
        return  DB::table('office_expense_detail_tb')
                ->join('office_expense_category', 'office_expense_detail_tb.expense_category', '=', 'office_expense_category.id')
                ->join('account_head_tb','account_head_tb.id', '=','office_expense_detail_tb.account_head_id')
                ->select('office_expense_detail_tb.*', 'office_expense_category.expense_category_name','account_head_tb.account_head_type')
                ->where('office_expense_detail_tb.delete_flag',0)
                ->get();
    }

    public function getAllProjectExpense() {
        $getAllProjectExpense = DB::table('project_expense_tb')
        ->join('project_tb','project_tb.id','=','project_expense_tb.project_id')
        ->select('project_expense_tb.*','project_tb.name')
        ->where('project_expense_tb.delete_flag',0)
        ->get();
        return $getAllProjectExpense;
    }

    public function getAllBankExpense() {

        $getAllBankExpense = DB::table('bank_expense_tb')
        ->join('loan_detail_tb','loan_detail_tb.id','=','bank_expense_tb.loan_transfer_id')
        ->select('bank_expense_tb.*','loan_detail_tb.description')
        ->where('bank_expense_tb.delete_flag',0)
        ->get();
        return $getAllBankExpense;
    }

    public function getAllBank(){
        $banks = DB::table('bank_tb')->orderby('created_at','desc')->where('delete_flag',0)->get();
        return $banks;
    }

    public function getAllLoanTransfer(){
        $getLoanTransfer = DB::table('loan_detail_tb')
        ->join('bank_tb','bank_tb.id','=','loan_detail_tb.bank_detail_id')
        ->select('loan_detail_tb.*','bank_tb.name')
        ->where('loan_detail_tb.delete_flag',0)->get();
        
        return $getLoanTransfer;
    }



//  Detail Groups

    public function getAllOfficeExpenseByExpenseCatId($id) {
        
        $officeExpenseDetail = DB::table('office_expense_detail_tb')->where('delete_flag',0)->where('expense_category',$id)->get();

        if(sizeof($officeExpenseDetail) > 0) {
            $totalBalance = $this->calculateTotalBalance($officeExpenseDetail);  
        }
        
        return view('head_quater.office_expense_detail',compact('officeExpenseDetail','totalBalance'));
    }

    public function getAllOfficeExpenseByProjectId($id) {
        
        $officeExpenseDetailByProjectId = DB::table('office_expense_detail_tb')
        
        ->join('office_expense_category', 'office_expense_category.id', '=', 'office_expense_detail_tb.expense_category')

        ->select('office_expense_detail_tb.*','office_expense_category.expense_category_name')
        
        ->where('office_expense_detail_tb.delete_flag',0)
        
        ->where('project_id',$id)
        
        ->get();

        if(sizeof($officeExpenseDetailByProjectId) > 0) {

            $totalBalance = $this->calculateTotalBalance($officeExpenseDetailByProjectId);  
        }
        
        return view('head_quater.office_expense_detail_by_project',compact('officeExpenseDetailByProjectId','totalBalance'));
    }

    public function getAllProjectExpenseByProjectId($id){

        $projectExpenseDetail = DB::table('project_expense_detail_tb')->where('delete_flag',0)->where('project_id',$id)->get();

        if(sizeof($projectExpenseDetail) > 0) {

            $totalBalance = $this->calculateTotalBalance($projectExpenseDetail);  
        }
        
        return view('head_quater.project_expense_detail',compact('projectExpenseDetail','totalBalance'));   
    }

    public function calculateTotalBalance($total_amount) {
        $totalBalance = 0;
        foreach ($total_amount as $data) {
            $totalBalance += $data->amount;
        }
        return $totalBalance;
    }

    public function showExpenseCategory() {
        $getAllExpenseCategory = DB::table('office_expense_category')
        ->where('delete_flag',0)->get();
        return $getAllExpenseCategory;
    }

    public function getAllProject() {
        
        $projects = DB::table('project_tb')->orderby('created_at','desc')->where('delete_flag',0)->get();
        
        return $projects;   
    }

    public function getBankExpenseById($id)
    {
        $loanDetail = DB::table('bank_expense_tb')->select('*')->where('loan_transfer_id',$id)->get();
        return view('head_quater.loan_detail',compact('loanDetail'));
    }



    // Common Function For Edit

    /**
     * Common Edit Function for Expense
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function EditExpenseById(Request $request,$id){
        $getEditData = [];
        $url = $request->path();
        $explodeUrl = explode("/",$url);

        // Expense
        if ( $explodeUrl[1] == "office_expense_detail") {

            $tableName = "office_expense_detail_tb";
            $idAttrName = "office_expense_detail_id";
            $getEditData['table_name']  = $tableName;
        }
        // Project
        else if ($explodeUrl[1] == "project_expense_detail") {
                    $tableName = "project_expense_detail_tb";
            $idAttrName = "project_expense_detail_id";
            $getEditData['table_name']  = $tableName;
        }
        // Bank
        else if ($explodeUrl[1] == "bank_expense_detail") {
            $tableName = "bank_expense_tb";
            $idAttrName = "id";
            $getEditData['table_name']  = $tableName;
        }

        // PO


        // PG
        $getEditData[] = DB::table($tableName)->select("*")
                            ->where($idAttrName,$id)
                            ->where('delete_flag',0)
                            ->get();
        return view ('head_quater.edit_expense_detail',compact('getEditData'));
    }

    /**
     * Common updated for expense
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function UpdateExpendById(Request $request,$id)
    {
        $url = $request->path();
        $explodeUrl = explode("/", $url);

        // update records from request
        $updateRecords = [
            'account_head_type' => $request->accountHead,
            'transaction_update_amount' => $request->amount,
            'change_status' => null,
            'remark' => $request->description,
        ];

        if ($explodeUrl[1] == 'office_expense_detail') {
            $transactionOrginalAmount = DB::table('office_expense_detail_tb')->select('amount')->where('office_expense_detail_id', $id)->first();
            $originalAmount = $transactionOrginalAmount->amount;
            $updateRecords['transaction_original_amount'] = $originalAmount;
            $updateRecords['office_expend_detail_id'] = $id;

            $tableName = 'office_expense_detail_tb';
            $idAttrName = 'office_expense_detail_id';
            $totalAmountFieldName = 'amount';
        }
        elseif ($explodeUrl[1] == 'project_expense_detail') {

            $transactionOrginalAmount = DB::table('project_expense_detail_tb')->select('amount')->where('project_expense_detail_id', $id)->first();
            $originalAmount = $transactionOrginalAmount->amount;
            $updateRecords['transaction_original_amount'] = $originalAmount;
            $updateRecords['office_expend_detail_id'] = $id;

            $tableName = 'project_expense_detail_tb';
            $idAttrName = 'project_expense_detail_id';
            $totalAmountFieldName = 'amount';
        }
        elseif ($explodeUrl[1] == 'bank_expense_detail') {
            $transactionOrginalAmount = DB::table('bank_expense_tb')->select('payback_amount')->where('id', $id)->first();
            $originalAmount = $transactionOrginalAmount->payback_amount;
            $updateRecords['transaction_original_amount'] = $originalAmount;
            $updateRecords['bank_expend_detail_id'] = $id;

            $tableName = 'bank_expense_tb';
            $idAttrName = 'id';
            $totalAmountFieldName = 'payback_amount';

            //update into bank_detail_tb income
            DB::update('update loan_detail_tb set payback_amount = ?  where id = ?',[$updateRecords['transaction_update_amount'],$request->loan_transfer_id]);
        }


        // Calculate Different Amount and Define Change Status
        $updateAmount = $request->amount;
        $diffAmount = $this->calculateDiffAmount($originalAmount, $updateAmount);
        $updateRecords['diff_amount'] = $diffAmount['diff_amount'];
        $updateRecords['change_status'] = $diffAmount['change_status'];

        // Updated data by detail Id
        $updateDetail = DB::table($tableName)->where($idAttrName, $id)
            ->where('delete_flag',0)
            ->update([$totalAmountFieldName => $updateAmount, 'description' => $updateRecords['remark']]);

        if($updateDetail == 1 ) {
                // temporary code .... fixing soon in field "id" into bank_expense_tb
                if($explodeUrl[1] == 'bank_expense_detail') {
                    $idAttrName = "bank_expense_detail_id";
                }
                // end

            // Insert Into record histories
            $insertRecord = DB::table('record_histroies_tb')->insert([$idAttrName => $id,
                                'account_head_type' => $updateRecords['account_head_type'],
                                'transaction_update_amount' => $updateAmount,
                                'transaction_original_amount' => $originalAmount,
                                'change_status' => $updateRecords['change_status'],
                                'diff_amount' => $updateRecords['diff_amount'],
                                'remark' => $updateRecords['remark']
            ]);

            if ($insertRecord == 1) {
                // Insert Into Cashbook
                DB::table('cash_book_tb')->where('deleted_flag',0)
                    ->where($idAttrName, $id)->where('deleted_flag',0)
                    ->update(['expend' => $updateAmount, 'description' => $updateRecords['remark']]);
            }
        }
        return redirect("/head_quater/expend_cashbook");
    }

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

}
