<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectExpenseController extends Controller
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

        $datas = \DB::table('site_cashbook')->where('project_id',$userRelatedProjectId)->orderBy('id','asc')->paginate(15);

        foreach($datas as $data){
            $data->project_name = \DB::table('project_tb')->where('id',$data->project_id)->first('name');
        }
        return view('project_expense.index',compact('datas','projectName'));
    }

    public function store()
    {

        $getProjectId = \DB::table('project_tb')->where('name',request()->project)->first()->id;

        \DB::table('site_cashbook')->insert([
            'project_id' =>   $getProjectId,
            'expend' =>       request()->amount,
            'description' =>  request()->description,
            'user_id'   => auth()->id(),
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);


        return back();

    }

    public function edit($id)
    {
        $projectExpense = \DB::table('site_cashbook')->where('id',$id)->first();
        $projectName = \DB::table('project_tb')->where('id', $projectExpense->project_id)->first();
        return view('project_expense.edit',compact('projectExpense','projectName'));
    }

    public function update(Request $request,$id)
    {
        $site_cashbook = \DB::table('site_cashbook')->where('id',$id)->first();

        \DB::table('site_cashbook')->where('id',$id)->update([
            'expend' =>       request()->amount,
            'description' =>  request()->description,
            'edit_status' => 1
        ]);
        

        \DB::table('site_cashbook_edit_record')->insert([
            'site_cashbook_id' => $site_cashbook->id,
            'original_expend' => $site_cashbook->expend,
            'update_expend' => request()->amount
        ]);

    	return redirect('/project-expense');
    }

    public function record($id)
    {
        $site_cashbook = \DB::table('site_cashbook_edit_record')->where('site_cashbook_id',$id)->get();
        return view('project_expense.record',compact('site_cashbook'));
    }
}
