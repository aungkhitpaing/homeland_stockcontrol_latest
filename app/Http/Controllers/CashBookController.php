<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\TransactionExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CashBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    /**
     * Show a list of all of the bank.
     *
     * @return bank
     */
    public function index()
    {
        $account_head_types = DB::table('account_head_tb')->get();

        $getTransactions = DB::table('cash_book_tb')
            ->orderby('id', 'asc')
            ->join('account_head_tb', 'account_head_tb.id', '=', 'cash_book_tb.account_head_id')
            ->select('cash_book_tb.*', 'account_head_tb.account_head_type')
            ->where('deleted_flag', 0)->paginate(15);

        return view('head_quater.cashBook', compact('account_head_types', 'getTransactions'));
    }

    /**
     * Export Excel For Transaction
     *
     * @return void
     */
    public function excelExport()
    {
        return Excel::download(new TransactionExport, 'transaction.xlsx');
    }
}
