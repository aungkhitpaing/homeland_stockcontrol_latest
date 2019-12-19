<?php

namespace App\Exports;


use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class exportByPayable implements FromCollection, WithHeadings, ShouldAutoSize
{

    public function collection()
    {
        $inputs = request()->only([
            'project',
            'stock',
            'from_date',
            'to_date'
        ]);
        if(!empty($inputs['stock'])) {
            $getPaybackAmount = DB::table('payable_tb')->select('*')->where('stock_id', $inputs['stock'])->where('project_id',$inputs['project'])->get()->toArray();
        } else {
            $getPaybackAmount = DB::table('payable_tb')->select('*')->where('project_id',$inputs['project'])->get()->toArray();
        }

        if(!empty($getPaybackAmount)) {
            try {
                if( ($getPaybackAmount[0]->payback_amount == null) || ($getPaybackAmount[0]->payback_amount != $getPaybackAmount[0]->total_amount) ) {
                    $datas = DB::table('payable_tb')->select("*");
                    $datas->where('project_id', $inputs['project']);
                    if (!empty($inputs['stock'])) {
                        $datas->where('stock_id', $inputs['stock']);
                    }
                    $datas->whereBetween('created_at', [$inputs['from_date'], $inputs['to_date']]);
                    $datas->where('delete_flag', 0);
                    $datas->get()->toArray();
                }
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
        }
        return $datas;
    }


    public function headings(): array
    {
        return [
            'Account_head',
            'Total Expend Amount',
        ];
    }
}