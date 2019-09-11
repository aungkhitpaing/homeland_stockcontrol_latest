<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeadQuaterExpandController extends Controller
{

	public function index() {
        
        $getAllOfficeExpense = $this->getAllOfficeExpense();
        $getAllProjectExpense = $this->getAllProjectExpense();
        $getAllBankExpense = $this->getAllBankExpense();

        return view('head_quater.expend_cashbook',compact('getAllOfficeExpense','getAllProjectExpense','getAllBankExpense'));
    }

    public function create() {

        $accountHeads = $this->getAllAccountHead();
        
        $getAllExpenseCategories = $this->showExpenseCategory();
    	
        $getAllProjects = $this->getAllProject();

        $banks = $this->getAllBank();

        $getAllLoanTransfer = $this->getAllLoanTransfer();

        return view ('head_quater.add_expend', compact('accountHeads','getAllExpenseCategories','getAllProjects','banks','getAllLoanTransfer'));
    }



// store
    
    public function storeDailyExpend(Request $request) {
    	
        $officeExpenseReq = [
            'project_id' => $request->project,
            'expense_category' => $request->dailyexpend,
            'payment_type' => $request->optionsRadios,
            'amount' => $request->amount,
            'description' => $request->description
        ];

        $specification_id = $request->project;
        $getCashbookInfo = $this->getCashbookInfo($request,$request->accountHead,$specification_id);
    	
        try { 

            // check row count of  detail 
            $expenseDetailByProject = DB::table('office_expense_detail_tb')->orderby('created_at','desc')
                             ->where('delete_flag',0)
                             ->where('project_id',$request->project)
                             ->get();


            if (sizeof($expenseDetailByProject) == 0 ) {
                
                $insertOfficeExpense = DB::table('office_expense_detail_tb')->insert([
                    'project_id' => $request->project,
                    'expense_category' => $request->dailyexpend,
                    'payment_type' => $request->optionsRadios,
                    'amount' => $request->amount,
                    'description' =>$request->description,
                ]);
            } else {

                $totalBalance = DB::table('office_expense_tb')->where('project_id',$request->project)->first();
                
                $updateTotalBalance = DB::table('office_expense_tb')->where('project_id',$request->project)->update(['total_expense_balance' => $totalBalance->total_expense_balance + $request->amount]);
                
            }

            $insertOfficeExpense = DB::table('office_expense_detail_tb')->insert($officeExpenseReq);

    		$insertDailyExpendIntoCashBook = DB::table('cash_book_tb')->insert($getCashbookInfo);

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
        ];

        $specification_id = $request->project;
        $getCashbookInfo = $this->getCashbookInfo($request,$request->accountHead,$specification_id);
        
        try { 

            // check row count of  detail 
            $projectExpenseDetail = DB::table('project_expense_detail_tb')->orderby('created_at','desc')
                             ->where('delete_flag',0)
                             ->where('project_id',$request->project)
                             ->get();


            if (sizeof($projectExpenseDetail) == 0 ) {
                
                $insertProjectExpense = DB::table('project_expense_tb')->insert([
                    'project_id' => $request->project,
                    'total_expense_balance' => $request->amount,
                ]);

            } else {

                $totalBalance = DB::table('project_expense_tb')->where('project_id',$request->project)->first();
                
                $updateTotalBalance = DB::table('project_expense_tb')->where('project_id',$request->project)->update(['total_expense_balance' => $totalBalance->total_expense_balance + $request->amount]);
                
            }

            $insertProjectExpense = DB::table('project_expense_detail_tb')->insert($projectExpenseReq);

            $insertDailyExpendIntoCashBook = DB::table('cash_book_tb')->insert($getCashbookInfo);

            return redirect('/head_quater/alltransaction');

        } catch (Exception $e) {

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

                    $insertBankExpense = DB::table('bank_expense_tb')->insert([
                        'account_head_type' => $request->accountHead ,
                        'loan_transfer_id' => $request->loan_transfer_id,
                        'payment_type' => $request->optionsRadios,
                        'payback_amount' => $request->amount,
                        'description' => $request->description,
                    ]);


                    $insertBankExpenseIntoCashBook = DB::table('cash_book_tb')->insert($getCashBookInfo);

                    return redirect('/head_quater/income_cashbook/');
                
                } else {

                    return redirect('/head_quater/add_expend');
                }   
            }           
        
        } catch (Exception $e) {

            return $e->getMessage();
        }
    }



    public function getRowCountFromCashBook() {
    	
        $rowCounts = DB::table('cash_book_tb')->get();
    	
        return $rowCounts;
    }

    public function getCashbookInfo(Request $request, $accoundhead_id, $specification_id = null) {
    	
    	$cashBookInfo = [
			'account_head_id' => $accoundhead_id,
			'payment_type' => $request->optionsRadios,
			'expend' => (int)$request->amount,
			'description' => $request->description,
            'specification_id' => $specification_id,
		];

    	$getRowCountFromCashBook = $this->getRowCountFromCashBook();

    	if(sizeof($getRowCountFromCashBook) > 0) {
    		$getBalanceAmount = DB::table('cash_book_tb')->latest('id')->first();
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
        $getAllOfficeExpense = DB::table('office_expense_tb')
        ->join('office_expense_category', 'office_expense_tb.id', '=', 'office_expense_category.id')
        ->join('project_tb','project_tb.id','=','office_expense_tb.project_id')
        ->select('office_expense_tb.*', 'office_expense_category.expense_category_name','project_tb.name')
        ->where('office_expense_tb.delete_flag',0)
        ->get();
        return $getAllOfficeExpense;
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




}
