<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PaymentOrderController extends Controller
{
    /**
     * Show a list of all of the PO.
     *
     * @return PO
     */
    public function index()
    {
        $payment_orders = DB::table('payment_order_tb')->where('delete_flag',0)->get();
        return view('payment_order.show',compact('payment_orders'));
    }

    public function create()
    {
        return view('payment_order.create');
    }

    /**
     * store payment_order
     *
     * @return Response
     */
    public function store(Request $request) {
    
    if($request)
        try {
            $storeProject = DB::table('payment_order_tb')->insert([
                'code' => "PO_".$request->po_code, 
                'name' => $request->po_name,
            ]);
            return redirect('/payment_order');      
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
        $editPaymentOrder = DB::table('payment_order_tb')->where('id',$id)->get();
        return view('payment_order.edit',compact('editPaymentOrder'));
    }

    /**
     * retrieve update payment_order
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $editProject = DB::table('payment_order_tb')->where('id',$id)->update([
            'code' => "PO_".$request->po_code, 
            'name' => $request->po_name
        ]);
        return redirect('/payment_order');
    }

    public function delete($id)
    {
        $deleteInvestor = DB::table('payment_order_tb')->where('id',$id)->update([
            'delete_flag' => 1
        ]);
        return redirect('/payment_order');
    }

}
