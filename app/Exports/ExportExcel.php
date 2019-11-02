<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;

class ExportExcel implements FromCollection, WithHeadings, ShouldAutoSize
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

        $open_amount = $datas[0]->income;

        $datas[0]->balance = $open_amount;

        for ($i = 1; $i < sizeof($datas); $i++) {

            $x = $i - 1;

            if ($datas[$i]->income > 0) {

//                $updateBalance = abs($datas[$x]->balance + $datas[$i]->income);
                $updateBalance = $datas[$x]->balance + $datas[$i]->income;
            }

            if ($datas[$i]->expend > 0) {
//                $updateBalance = abs($datas[$x]->balance - $datas[$i]->expend);
                $updateBalance = $datas[$x]->balance - $datas[$i]->expend;
            }

            $datas[$i]->balance = $updateBalance;
        }

        foreach ($datas as $data) {
            $data->id = $data->created_at;
            $data->specification_id = $data->account_head_type;
            $data->account_head_id = $data->description;
        }

        return $this->selectCustomColumns($datas);
    }

    /**
     *
     *
     * @param [select Custom Columns] $datas
     * @return void
     */
    public function selectCustomColumns($datas,$headers)
    {
        $datas = collect($datas);
        $dump = $datas->map(function ($data) {
            return collect($data)
                ->only([
                    'id',
                    'specification_id',
                    'account_head_id',
                    'payment_type',
                    'income',
                    'expend',
                    'balance',
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
            'Create Date',
            'Account Head',
            'Description',
            'Payment Type',
            'Credit',
            'Debit',
            'Balance',

        ];
    }
}
