<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use DB;

class RecordHistoryExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = DB::table('record_histories_tb')
            ->orderby('id', 'asc')
            ->join('account_head_tb', 'account_head_tb.id', '=', 'record_histories_tb.account_head_type');

        if (request()->account_head_type) {
            $query = $query->where('account_head_type', '=', request()->account_head_type);
        }

        $datas = $query->select('record_histories_tb.*', 'account_head_tb.account_head_type')
            ->where('deleted_flag', 0)
            ->whereBetween('record_histories.created_at', [request()->from_date, request()->to_date])
            ->get()
            ->toArray();

        dd($datas);

//        foreach ($datas as $data) {
//            $data->id = $data->created_at;
//            $data->specification_id = $data->account_head_type;
//            $data->account_head_id = $data->description;
//        }

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
