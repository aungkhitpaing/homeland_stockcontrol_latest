<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Show a list of all of the bank.
     *
     * @return bank
     */
    public function index()
    {
        $banks = DB::table('bank_tb')->where('delete_flag',0)->get();
        return view('bank.show',compact('banks'));
    }

    public function create()
    {
        return view('bank.create');
    }

    /**
     * create store bank
     *
     * @return Response
     */
    public function store(Request $request) {
    if($request)
        try {
            $storeBank = DB::table('bank_tb')->insert([
                'code' => "B_".$request->bank_code, 
                'name' => $request->bank_name,
            ]);
            return redirect('/bank');      
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * retrieve edit bank
     *
     * @return Response
     */
    public function edit($id)
    {
        $editBank = DB::table('bank_tb')->where('id',$id)->get();
        return view('bank.edit',compact('editBank'));
    }

    /**
     * retrieve update bank
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $updateBank = DB::table('bank_tb')->where('id',$id)->update([
            'code' => "B_".$request->bank_code, 
            'name' => $request->bank_name
        ]);
        return redirect('/bank');
    }

    public function delete($id)
    {
        $deletebank = DB::table('bank_tb')->where('id',$id)->update([
            'delete_flag' => 1
        ]);
        return redirect('/bank');
    }
}
