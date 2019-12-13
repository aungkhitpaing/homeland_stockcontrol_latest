<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class exportByAccoutHead implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function __construct($account_head_id,$project_id,$payment_type)
    {
        $this->account_head_id = $account_head_id;
        $this->project_id      = $project_id;
        $this->payment_type    = $payment_type;
    }

    public function collection()
    {
        $datas = \DB::table('site_cashbook')->where('site_account_head_id',$this->account_head_id)
                        ->where('project_id',$this->project_id)
                        ->where('payment_type',$this->payment_type)
                        ->where('is_check',1)
                        ->get();
        foreach($datas as $data){
            $data->project_id = \DB::table('project_tb')->where('id',$data->project_id)
                                ->first()->name;

            $data->account_head_id =  \DB::table('site_account_head_tb')->where('id',$data->site_account_head_id)
                                    ->first()->account_head_type;
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
                    'expend',
                    'account_head_id',
                    'project_id',
                    'payment_type',
                    'created_at'
                ])
                ->all();
        });

        return $dump;
    }

    public function headings(): array
    {
        return [
            'Account_head',
            'Payment Type',
            'Expend',
            'Create Date',
            'project',
        ];
    }

    

   
}
