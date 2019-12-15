<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
    	$getTransactions = $this->getAlltransaction();
    	$getTotalIncomeCash = $this->getTotalIncomeCash();
    	$getTotalIncomeBank = $this->getTotalIncomeBank();
    	$getTotalExpendCash = $this->getTotalExpendCash();
    	$getTotalExpendBank = $this->getTotalExpendBank();
    	$balance = $this->getTotalBalance();
        $getWarehouseData = $this->getWarehouseData();
        $headQuaterInfos = $this->getHQInfos();
        $accountHeads = DB::table('account_head_tb')->select('*')->where('delete_flag',0)->get();

//    	$balance = $getTotalBalance->balance;
        return view('main.index',compact('getAlltransactions','getTotalIncomeCash','getTotalIncomeBank',
        	'getTotalExpendCash','getTotalExpendBank','balance','getWarehouseData','headQuaterInfos','accountHeads'));
    }

    public function getAlltransaction(){
    $getTransactions = DB::table('cash_book_tb')
        ->orderby('id','asc')
        ->join('account_head_tb', 'account_head_tb.id', '=', 'cash_book_tb.account_head_id')
        ->select('cash_book_tb.*', 'account_head_tb.account_head_type')
        ->where('deleted_flag',0)->get();
        return $getTransactions;
    }

    public function getTotalIncomeCash(){
    	
    	$getIncome = DB::table('cash_book_tb')->where('payment_type','Cash')->where('deleted_flag',0)->get();
    	$expend = $this->getTotalExpendCash();
        $income = 0;

    	if (!empty($getIncome)) {
    		
    		foreach ($getIncome as $data) {
    			$income  += $data->income;		
    		}
    	}

        $cash = $income - $expend;
    	return $cash;	
    }



    public function getTotalIncomeBank(){

    	$getBankIncome = DB::table('cash_book_tb')->where('payment_type','Bank')->where('deleted_flag',0)->get();
    	$income = 0;
        $expend = $this->getTotalExpendBank();
    	if (!empty($getBankIncome)) {
    		
    		foreach ($getBankIncome as $data) {
    			$income  += $data->income;		
    		}
    	}
        $cash = $income - $expend;
    	return $cash;
    }


    public function getTotalExpendCash(){
    	
    	$getTotal = DB::table('cash_book_tb')->where('payment_type','Cash')->where('deleted_flag',0)->get();
    	
    	$cashExpend = 0;
    	
    	if (!empty($getTotal)) {
    		
    		foreach ($getTotal as $data) {
    			$cashExpend  += $data->expend;		
    		}
    	}
    	return $cashExpend;	
    }

    public function getTotalExpendBank(){
    	
    	$getTotal = DB::table('cash_book_tb')->where('payment_type','Bank')->where('deleted_flag',0)->get();
    	
    	$bankExpend = 0;
    	
    	if (!empty($getTotal)) {
    		
    		foreach ($getTotal as $data) {
    			$bankExpend  += $data->expend;		
    		}
    	}
    	return $bankExpend;	
    }

    public function getTotalBalance(){
        $increaseDiffAmount = DB::table('record_histroies_tb')->select('diff_amount')->where('change_status','increase')->get();
        $totalIncrease = 0;
        if (sizeof($increaseDiffAmount) > 0) {
            foreach($increaseDiffAmount as $diffAmount ) {
                $totalIncrease += $diffAmount->diff_amount;
            }
        }

        $decreaseDiffAmount = DB::table('record_histroies_tb')->select('diff_amount')->where('change_status','decrease')->get();
        $totalDecrease = 0;
        if (sizeof($decreaseDiffAmount) > 0 ) {
            foreach($decreaseDiffAmount as $diffAmount) {
                $totalDecrease += $diffAmount->diff_amount;
            }
        }
        $result = $totalIncrease + $totalDecrease;
        $originalTotalBalance = DB::table('cash_book_tb')->select('balance')->where('deleted_flag',0)->latest('id')->first();
        if(!empty($originalTotalBalance->balance)) {
            return (int)$originalTotalBalance->balance + $result;
        } else {
            $balance = 0;
            return $balance;
        }

    }

    public  function getWarehouseData(){
        $getAllData = DB::table('warehouse_tb as w')
            ->join('stocks_tb as s','s.stock_id','=','w.stock_id')
            ->join('project_tb as p','p.id','=','w.project_id')
            ->select('w.id','w.total_quantity','w.created_at','w.used_quantity','s.stock_name','s.unit','p.name')
            ->where('w.delete_flag',0)->get();
        return $getAllData;
    }

    public function getHQInfos() {
        $headQuatorInfo = [];
        $headQuatorInfo['investor'] = DB::table("invester_tb")->select("*")->where('delete_flag',0)->get()->count();
        $headQuatorInfo['project'] = DB::table('project_tb')->select("*")->where('delete_flag',0)->get()->count();
        $headQuatorInfo['bank_loan'] = DB::table('loan_detail_tb')->select("*")->where('delete_flag',0)->get()->count();
        $headQuatorInfo['tinder'] = DB::table('popg_tb')->select("*")->where('delete_flag',0)->get()->count();
        return $headQuatorInfo;
    }
    
    public function logout()
    {
        auth()->logout();
        return back();
    }
}
