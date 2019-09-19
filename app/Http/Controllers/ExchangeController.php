<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExchangeController extends Controller
{
    public function index()
    {   
        return view('exchange.show');
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


    public function create() {
        
        $accountHeads = $this->getAllAccountHead();

        return view('exchange.create',compact('accountHeads'));
    }

    public function getAllAccountHead() {

        $getAllAccountHead = DB::table('account_head_tb')->where('delete_flag',0)->get();
        
        return $getAllAccountHead;
    
    }

    public function exchangeCalculate(Request $request) {

        $exchangeAmount = $request->amount;
    
        $exchangeTypeRadios = $request->exchangeTypeRadios;

        if ($exchangeTypeRadios == 0 ) {  // Cash to Bank (cash -  |  Bank + )
        
        $cashIncome = $this->getTotalIncomeCash() - $exchangeAmount; 
        
        $cashExpend = $this->

        $bankTotal = $this->s

        } else { // Bank to Cash


        }


        

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
