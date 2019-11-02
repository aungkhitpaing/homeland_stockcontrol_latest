<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $projectUsers = \DB::table('project_user')->get();
        return view('project_user.index',compact('projectUsers'));
    }

    public function store(Request $request)
    {
        $checkProject = \DB::table('project_user')->where('project_id',$request->project_id)->first();
        if($checkProject){
            \Session::flash('message', 'This project have already assigned !'); 
            return back();
        }

        $checkUser = \DB::table('project_user')->where('user_id',$request->user_id)->first();
        if($checkUser){
            \Session::flash('message', 'This user have already assigned !');             
            return back();
        }

        else{ 
            \DB::table('project_user')->insert([
                'project_id' => $request->project_id,
                'user_id' => $request->user_id
             ]);

             return back();
        }

    }

    public function destroy($id)
    {
        \DB::table('project_user')->where('id',$id)->delete();
        return back();
    }
}
