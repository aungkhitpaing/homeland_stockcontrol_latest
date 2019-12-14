<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteAccountHeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
	/**
     * Show a list of all of the Account Head.
     *
     * @return bank
     */
    public function index()
    {
        $accountHeads = DB::table('site_account_head_tb')->where('delete_flag',0)->get();
        return view('site_account_head.show',compact('accountHeads'));
    }

    public function create()
    {
        return view('site_account_head.create');
    }

    /**
     * create store account head
     *
     * @return Response
     */
    public function store(Request $request) {
    if($request)
        try {
            $store = DB::table('site_account_head_tb')->insert([
                'account_head_code' => $request->accounthead_code, 
                'account_head_type' => $request->accounthead_name,
            ]);
            return redirect('/site-accounthead');
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
        $accountHead = DB::table('site_account_head_tb')->where('id',$id)->get();
        return view('site_account_head.edit',compact('accountHead'));
    }

    /**
     * retrieve update accounthead
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $updateBank = DB::table('site_account_head_tb')->where('id',$id)->update([
            'account_head_code' => $request->accounthead_code, 
            'account_head_type' => $request->accounthead_name,
        ]);
        return redirect('/site-accounthead');
    }

    public function delete($id)
    {
        $deletebank = DB::table('site_account_head_tb')->where('id',$id)->update([
            'delete_flag' => 1
        ]);
        return redirect('/site-accounthead');
    }
}
