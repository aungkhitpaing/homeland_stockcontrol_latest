<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function index()
    {
    	$getTransactions = $this->getAlltransaction();
    	$getTotalIncomeCash = $this->getTotalIncomeCash();
    	$getTotalIncomeBank = $this->getTotalIncomeBank();
    	$getTotalExpendCash = $this->getTotalExpendCash();
    	$getTotalExpendBank = $this->getTotalExpendBank();
    	$getTotalBalance = $this->getTotalBalance();
    	$balance = $getTotalBalance->balance;
        return view('main.index',compact('getAlltransactions','getTotalIncomeCash','getTotalIncomeBank',
        	'getTotalExpendCash','getTotalExpendBank','balance'));
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
    	return DB::table('cash_book_tb')->select('balance')->where('deleted_flag',0)->latest('id')->first();
    }


}
