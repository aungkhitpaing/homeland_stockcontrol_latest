<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('site-manager');
    }
    
    public function index()
    {
        $projectForLoginUser = \DB::table('project_user')->where('user_id', \Auth::user()->id)->first();
        $projectName = \DB::table('project_tb')->where('id', $projectForLoginUser->project_id)->first();
        
        $userRelatedProjectId = \DB::table('project_user')->where('user_id',\Auth::user()->id)->first()->project_id;

        $datas = \DB::table('project_order')->where('project_id',$userRelatedProjectId)->orderBy('id','desc')->get()->toArray();

        foreach($datas as $data){
            $data->project_name = \DB::table('project_tb')->where('id',$data->project_id)->first('name');
        }

        return view('project_order.index',compact('projectName','datas'));
    }

    public function getStockPrice($stock_id)
    {
        $stock = \DB::table('stocks')->where('id',$stock_id)->first();
        return response()->json($stock);
    }

    public function store()
    {
        $getProjectId = \DB::table('project_tb')->where('name',request()->project)->first()->id;

        \DB::table('project_order')->insert([
            'stock_id'   =>   request()->stock,
            'project_id' =>   $getProjectId,
            'quantity'   =>   request()->qty,
            'amount'     =>   request()->amount,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        return back();

    }
}
