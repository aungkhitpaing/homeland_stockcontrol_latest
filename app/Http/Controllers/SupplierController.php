<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
    	$suppliers = \DB::table('suppliers')->get();
    	return view('supplier.index',compact('suppliers'));
    }

    public function store(Request $request)
    {
    	\DB::table('suppliers')->insert([
    		'supplier_name' => $request->supplier_name
    	]);

    	return back();
    }

    public function edit($id)
    {
    	$suppliers = \DB::table('suppliers')->find($id);
    	return view('supplier.edit',compact('suppliers'));
    }

    public function update(request $request,$id)
    {
    	\DB::table('suppliers')->where('id',$id)->update([
    		'supplier_name' => $request->supplier_name
    	]);
    	return redirect('/supplier');
    }

    public function destroy($id)
    {
    	\DB::table('suppliers')->where('id',$id)->delete();
    	return back();
    }
}
