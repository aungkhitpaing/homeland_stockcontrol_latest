<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\RecordHistoryExport;

class RecordHistoryController extends Controller
{

    /**
     * Show a list of all of the record histories.
     *
     * @return  $record
     */
    public function index()
    {
        $account_head_types = DB::table('account_head_tb')->get();
        $getRecordHistories = DB::table('record_histroies_tb')
            ->orderby('id', 'asc')
            ->join('account_head_tb', 'account_head_tb.id', '=', 'record_histroies_tb.account_head_type')
            ->select('record_histroies_tb.*', 'account_head_tb.account_head_type')
            ->get();
        return view('record_history.record_history', compact('getRecordHistories','account_head_types'));
    }
    public function excelExport()
    {
        dd('hello');
    }
}
