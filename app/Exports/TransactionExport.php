<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

class TransactionExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('cash_book_tb')
            ->orderby('id', 'asc')
            ->join('account_head_tb', 'account_head_tb.id', '=', 'cash_book_tb.account_head_id')
            ->where('account_head_type', '=', request()->account_head_type)
            ->select('cash_book_tb.*', 'account_head_tb.account_head_type')
            ->where('deleted_flag', 0)->get();
    }
}
