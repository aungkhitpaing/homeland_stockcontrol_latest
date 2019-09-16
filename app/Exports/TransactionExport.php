<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use DB;

class TransactionExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = DB::table('cash_book_tb')
            ->orderby('id', 'asc')
            ->join('account_head_tb', 'account_head_tb.id', '=', 'cash_book_tb.account_head_id');

        if (request()->account_head_type) {
            $query = $query->where('account_head_type', '=', request()->account_head_type);
        }

        if (request()->payment_type) {
            $query = $query->where('payment_type', '=', request()->payment_type);
        }

        $datas = $query->select('cash_book_tb.*', 'account_head_tb.account_head_type')
            ->where('deleted_flag', 0)
            ->whereBetween('cash_book_tb.created_at', [request()->from_date, request()->to_date])
            ->get()
            ->toArray();

        return $this->selectCustomColumns($datas);
    }

    /**
     * 
     *
     * @param [select Custom Columns] $datas
     * @return void
     */
    public function selectCustomColumns($datas)
    {
        $datas = collect($datas);

        $dump = $datas->map(function ($data) {
            return collect($data)
                ->only([
                    'specification_id',
                    'payment_type',
                    'income',
                    'expend',
                    'balance',
                    'description',
                    'created_at',
                    'account_head_type'
                ])
                ->all();
        });

        return $dump;
    }

    /**
     * headings
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Specification Name',
            'Payment Type',
            'Income',
            'Expend',
            'Balance',
            'Created Date',
            'Description',
            'Account Head Type',
        ];
    }
}
