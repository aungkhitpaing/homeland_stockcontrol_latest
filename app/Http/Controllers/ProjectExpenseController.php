<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\exportByAccoutHead;
use App\Exports\exportByAccoutHeadTotal;
use Maatwebsite\Excel\Facades\Excel;

class ProjectExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        if(auth()->user()->name != 'admin')
        {
            $projectForLoginUser = \DB::table('project_user')->where('user_id', \Auth::user()->id)->first();

            $projectName = \DB::table('project_tb')->where('id', $projectForLoginUser->project_id)->first();
                
            $userRelatedProjectId = \DB::table('project_user')->where('user_id',\Auth::user()->id)->first()->project_id;
            
            $datas = \DB::table('site_cashbook')->where('is_check',NULL)->where('project_id',$userRelatedProjectId)->orderBy('id','asc')->paginate(15);

            foreach($datas as $data){
                $data->project_name = \DB::table('project_tb')->where('id',$data->project_id)->first('name');
            }
            return view('project_expense.main',compact('datas','projectName'));
        }
        else{

            $projectForLoginUser = \DB::table('project_user')->get();

            $projectName = \DB::table('project_tb')->get();
                
            $datas = \DB::table('site_cashbook')->paginate(15);


            return view('project_expense.main',compact('datas','projectName'));
        }
    }
    
    public function create()
    {
        if(auth()->user()->name == 'admin')
        {
            $projectNames = \DB::table('project_tb')->get();
            
            return view('project_expense.index',compact('datas','projectNames'));
        }
        else{
            $projectForLoginUser = \DB::table('project_user')->where('user_id', \Auth::user()->id)->first();

            $projectName = \DB::table('project_tb')->where('id', $projectForLoginUser->project_id)->first();
                
            $userRelatedProjectId = \DB::table('project_user')->where('user_id',\Auth::user()->id)->first()->project_id;
            
            $datas = \DB::table('site_cashbook')->where('project_id',$userRelatedProjectId)->orderBy('id','asc')->paginate(15);
            
            foreach($datas as $data){
                $data->project_name = \DB::table('project_tb')->where('id',$data->project_id)->first('name');
            }
            return view('project_expense.index',compact('datas','projectName'));      
        }
        
    }
    
    public function store()
    {

        $projecId = \DB::table('project_tb')->where('name',request()->project_id)->first()->id;

        $data = \DB::table('site_cashbook')->where('project_id',$projecId)
                            ->where('income','!=',NULL)
                            ->get();

        if(count($data) > 0 || \Auth::user()->name == 'admin'){
            \DB::table('site_cashbook')->insert([
                'site_account_head_id' =>   request()->site_accountHead,
                'project_id' => $projecId,
                'expend' =>       request()->amount,
                'payment_type' => request()->optionsRadios,
                'is_check' => request()->check,
                'description' =>  request()->description,
                'user_id'   => auth()->id(),
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
                ]);
                
                return redirect('/project-expense');
        }
        else{
            dd('Fail!This project have not any income');
        }
        
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

        public function exportByAccoutHead()
        {
            $account_head_id = \DB::table('site_account_head_tb')->where('account_head_type',request()->account_head_type)
                            ->first()->id;

            $project_id = request()->project;

            $payment_type = request()->payment_type;

            return Excel::download(new exportByAccoutHead($account_head_id,$project_id,$payment_type), 'report.xlsx');

        }

        public function exportByAccoutHeadTotal()
        {
            $project_id = request()->project;

            return Excel::download(new exportByAccoutHeadTotal($project_id), 'report.xlsx');
        }

        public function checkAccountHeadStock($id)
        {
            $data = \DB::table('site_account_head_tb')->where('id',$id)->first();
            return $data->is_stock;
        }

        public function getStock($id)
        {
            $data = \DB::table('stocks_tb')->where('id',$id)->first();
            return $data;
        }
}
            