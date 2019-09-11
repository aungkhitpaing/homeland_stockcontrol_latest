<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Invester;

class InvesterController extends Controller
{
	/**
     * Show a list of all of the invester.
     *
     * @return invester
     */
    public function index()
    {
    	$investors = DB::table('invester_tb')->orderby('created_at','desc')->where('delete_flag',0)->get();
        return view('investor.show',compact('investors'));
    }

    public function create()
    {
    	return view('investor.add');
    }

    /**
     * create investor
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $storeInvestor = DB::table('invester_tb')->insert([
        	'code' => "I_".$request->investor_code, 
        	'name' => $request->investor_name,
        ]);
        return redirect('/investor');
    }


    /**
     * retrieve edit investor
     *
     * @return Response
     */
    public function edit($id)
    {
        $editInvestor = DB::table('invester_tb')->where('id',$id)->get();
        return view('investor.edit',compact('editInvestor'));
    }

    /**
     * retrieve update investor
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $editInvestor = DB::table('invester_tb')->where('id',$id)->update([
        	'code' => "I_".$request->investor_code, 
        	'name' => $request->investor_name
        ]);
        return redirect('/investor');
    }

    public function delete($id)
    {
        $deleteInvestor = DB::table('invester_tb')->where('id',$id)->update([
        	'delete_flag' => 1
        ]);
     	return redirect('/investor');
    }
}
