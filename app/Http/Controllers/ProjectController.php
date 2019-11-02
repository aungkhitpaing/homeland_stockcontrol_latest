<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    /**
     * Show a list of all of the invester.
     *
     * @return invester
     */
    public function index()
    {
        $projects = DB::table('project_tb')->where('delete_flag',0)->get();
        return view('project.show',compact('projects'));
    }

    public function create()
    {
        return view('project.create');
    }

    /**
     * create store project
     *
     * @return Response
     */
    public function store(Request $request) {
    
    if($request)
        try {
            $storeProject = DB::table('project_tb')->insert([
                'code' => "P_".$request->project_code, 
                'name' => $request->project_name,
            ]);
            return redirect('/project');      
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * retrieve edit project
     *
     * @return Response
     */
    public function edit($id)
    {
        $editProject = DB::table('project_tb')->where('id',$id)->get();
        return view('project.edit',compact('editProject'));
    }

    /**
     * retrieve update project
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $editProject = DB::table('project_tb')->where('id',$id)->update([
            'code' => "P_".$request->project_code, 
            'name' => $request->project_name
        ]);
        return redirect('/project');
    }

    public function delete($id)
    {
        $deleteInvestor = DB::table('project_tb')->where('id',$id)->update([
            'delete_flag' => 1
        ]);
        return redirect('/project');
    }

}
