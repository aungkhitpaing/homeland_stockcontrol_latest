<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CashBookController extends Controller
{
    /**
     * Show a list of all of the bank.
     *
     * @return bank
     */
    public function index()
    {
        $getTransactions = DB::table('cash_book_tb')
        ->orderby('id','asc')
        ->join('account_head_tb', 'account_head_tb.id', '=', 'cash_book_tb.account_head_id')
        ->select('cash_book_tb.*', 'account_head_tb.account_head_type')
        ->where('deleted_flag',0)->get();
        return view('head_quater.cashBook',compact('getTransactions'));
    }
}
