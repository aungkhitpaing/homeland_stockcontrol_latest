<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExchangeController extends Controller
{
    public function index()
    {
        $getAllExchangeData = $this->getALLExchangeData();
        return view('exchange.show',compact("getAllExchangeData"));
    }

    public function getALLExchangeData() {
        return  DB::table('exchange_transfer_tb')->where('delete_flag',0)->get();
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

        $requestInfo = [
            'account_head_id' => $request->accountHead,
            'exchange_rate' => $request->amount,
            'exchange_type' => $request->exchangeTypeRadios,
            'description' => $request->description,
        ];
        $requestInfo['original_cash_total_income'] = $this->getTotalIncomeCash();
        $requestInfo['original_bank_total_income'] = $this->getTotalIncomeBank();
        $requestInfo['original_cash_total_expend'] = $this->getTotalExpendCash();
        $requestInfo['original_bank_total_expend'] = $this->getTotalExpendBank();

        if ( $request->exchangeTypeRadios == 0 ) {
            // Cash to Bank (cash -  |  Bank + )
            // decrease from cash income , increase from cash expend
            // increase from bank income

            $requestInfo['payment_type'] = 'Bank';
            $requestInfo['updated_cash_total_income'] = $this->getTotalIncomeCash() - $request->amount; // decrease from cash income
            $requestInfo['updated_bank_total_income'] = $this->getTotalIncomeBank() + $request->amount; // increase from bank income
            $requestInfo['updated_cash_total_expend'] = $this->getTotalExpendCash() + $request->amount; // increase from cash expend

            if (!empty($requestInfo)) {
                try {
                    $insertExchange = DB::table('exchange_transfer_tb')->insert($requestInfo);
                    if($insertExchange) {
                        $getCashBookInfo =  $this->getCashbookInfo($requestInfo,$requestInfo['account_head_id'],$requestInfo['exchange_type']);
                        $asIncomeCashbook = DB::table('cash_book_tb')->insert($getCashBookInfo);
                        if($asIncomeCashbook) {
                            $requestInfo['payment_type'] = 'Cash';
                            $requestInfo['exchange_type'] = 1; // expend
                            $getCashBookInfo =  $this->getCashbookInfo($requestInfo,$requestInfo['account_head_id'],$requestInfo['exchange_type']);

                            DB::table('cash_book_tb')->insert($getCashBookInfo);
                        }
                        return redirect ('/exchange_transfer/');
                    }
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        } elseif ($request->exchangeTypeRadios == 1) {

            // Bank to Cash (cash + |  Bank - )
            // decrease from bank income , increase from bank expend
            // increase from cash income

            $requestInfo['payment_type'] = 'Bank';
            $requestInfo['updated_bank_total_income'] = $this->getTotalIncomeBank() - $request->amount; // increase from bank income
            $requestInfo['updated_bank_total_expend'] = $this->getTotalExpendCash() + $request->amount; // increase from cash expend
            $requestInfo['updated_cash_total_income'] = $this->getTotalIncomeCash() + $request->amount; // increase from cash expend

            if (!empty($requestInfo)) {
                try {
//                    dd($getCashBookInfo =  $this->getCashbookInfo($requestInfo, $requestInfo['account_head_id'],$requestInfo['exchange_type']));
                    $insertExchange = DB::table('exchange_transfer_tb')->insert($requestInfo);
                    if($insertExchange) {
                        $getCashBookInfo =  $this->getCashbookInfo($requestInfo,$requestInfo['account_head_id'],$requestInfo['exchange_type']);
                        $asIncomeCashbook = DB::table('cash_book_tb')->insert($getCashBookInfo);
                        if($asIncomeCashbook) {
                            $requestInfo['payment_type'] = 'Cash';
                            $requestInfo['exchange_type'] = 0; // expend
                            $getCashBookInfo =  $this->getCashbookInfo($requestInfo,$requestInfo['account_head_id'],$requestInfo['exchange_type']);
                            DB::table('cash_book_tb')->insert($getCashBookInfo);
                        }
                        return redirect ('/exchange_transfer/');
                    }
                } catch(Exception $e) {
                    return $e->getMessage();
                }
            }
        }
    }

    /**
     * getCashBook Information
     *
     * @return Response
     */
    public function getCashbookInfo($request,$accoundhead_id,$exchange_type){

        if($exchange_type == 0 ) {
            $cashBookInfo = [
                'account_head_id' => $accoundhead_id,
                'payment_type' => $request['payment_type'],
                'income' => (int)$request['exchange_rate'],
                'description' => $request['description'],
            ];
        } else {
            $cashBookInfo = [
                'account_head_id' => $accoundhead_id,
                'payment_type' => $request['payment_type'],
                'expend' => (int)$request['exchange_rate'],
                'description' => $request['description'],
            ];
        }

        $getRowCountFromCashBook = $this->getRowCountFromCashBook();
        if(sizeof($getRowCountFromCashBook) > 0) {
            $getBalanceAmount = DB::table('cash_book_tb')->latest('id')->first();

            // nothing for exchange because that transaction isn't use for other
            if($exchange_type == 0) {
                $cashBookInfo['balance'] = (int)$request['exchange_rate'] + $getBalanceAmount->balance;
            } else {
                $cashBookInfo['balance'] = ($getBalanceAmount->balance) - (int)$request['exchange_rate'];
            }
        } else {
            $cashBookInfo['balance'] = $request->amount + 0;
        }

        return $cashBookInfo;
    }

    public function getRowCountFromCashBook(){
        $rowCounts = DB::table('cash_book_tb')->get();
        return $rowCounts;
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
