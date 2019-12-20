<?php

namespace App\Exports;


use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class exportByAccoutHeadTotal implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function __construct($project_id)
    {
        $this->project_id      = $project_id;
    }
    
    public function collection()
    {

        $datas = \DB::table('site_cashbook')
                ->where('is_check',1)
                ->where('project_id',$this->project_id)
                ->select('account_head_id', \DB::raw('SUM(expend) as total_amount'))
                ->groupBy('account_head_id')
                ->get();

        foreach($datas as $data){
            $data->account_head_id =  \DB::table('account_head_tb')->where('id',$data->account_head_id)
            ->first()->account_head_type;
            $data->total_expend_amount = $data->total_amount;
        }

        return $this->selectCustomColumns($datas);
    }
    
    /**
    * @return \Illuminate\Support\Collection 
    */
    
    public function selectCustomColumns($datas)
    {
        
        $datas = collect($datas);
        $dump = $datas->map(function ($data) {
            return collect($data)
            ->only([
                'account_head_id',
                'total_expend_amount',
                ])
                ->all();
            });

            return $dump;
        }
        
        public function headings(): array
        {
            return [
                'Account_head',
                'Total Expend Amount',
            ];
        }
    }