<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountHeadController extends Controller
{
	/**
     * Show a list of all of the Account Head.
     *
     * @return bank
     */
    public function index()
    {
        $accountHeads = DB::table('account_head_tb')->where('delete_flag',0)->get();
        return view('account_head.show',compact('accountHeads'));
    }

    public function create()
    {
        return view('account_head.create');
    }

    /**
     * create store account head
     *
     * @return Response
     */
    public function store(Request $request) {
    if($request)
        try {
            $store = DB::table('account_head_tb')->insert([
                'account_head_code' => $request->accounthead_code, 
                'account_head_type' => $request->accounthead_name,
            ]);
            return redirect('/accounthead');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * retrieve edit accounthead
     *
     * @return Response
     */
    public function edit($id)
    {
        $accountHead = DB::table('account_head_tb')->where('id',$id)->get();
        return view('account_head.edit',compact('accountHead'));
    }

    /**
     * retrieve update accounthead
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $updateBank = DB::table('account_head_tb')->where('id',$id)->update([
            'account_head_code' => $request->accounthead_code, 
            'account_head_type' => $request->accounthead_name,
        ]);
        return redirect('/accounthead');
    }

    public function delete($id)
    {
        $deletebank = DB::table('account_head_tb')->where('id',$id)->update([
            'delete_flag' => 1
        ]);
        return redirect('/accounthead');
    }
}
