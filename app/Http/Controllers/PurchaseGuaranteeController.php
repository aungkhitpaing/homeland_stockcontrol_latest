<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PurchaseGuaranteeController extends Controller
{
    /**
     * Show a list of all of the PO.
     *
     * @return PO
     */
    public function index()
    {
        $purchase_guarantees = DB::table('purchase_guarantee_tb')->where('delete_flag',0)->get();
        return view('purchase_guarantee.show',compact('purchase_guarantees'));
    }

    public function create()
    {
        return view('purchase_guarantee.create');
    }

    /**
     * store payment_order
     *
     * @return Response
     */
    public function store(Request $request) {
    
    if($request)
        try {
            $storePurchaseGuarantee = DB::table('purchase_guarantee_tb')->insert([
                'code' => "PG_".$request->pg_code, 
                'name' => $request->pg_name,
            ]);
            return redirect('/purchase_guarantee');      
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * retrieve edit payment_order
     *
     * @return Response
     */
    public function edit($id)
    {
        $editPurchaseGuarantee = DB::table('purchase_guarantee_tb')->where('id',$id)->get();
        return view('purchase_guarantee.edit',compact('editPurchaseGuarantee'));
    }

    /**
     * retrieve update payment_order
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $updatePurchaseGuarantee = DB::table('purchase_guarantee_tb')->where('id',$id)->update([
            'code' => "PG_".$request->pg_code, 
            'name' => $request->pg_name
        ]);
        return redirect('/purchase_guarantee');
    }

    public function delete($id)
    {
        $deletePurchaseGuarantee = DB::table('purchase_guarantee_tb')->where('id',$id)->update([
            'delete_flag' => 1
        ]);
        return redirect('/purchase_guarantee');
    }

}
