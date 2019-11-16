<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payable;
use Illuminate\Support\Facades\DB;

class PayableController extends Controller
{
    //
    public function index() {
        $getAllData = DB::table('payable_tb')
            ->leftjoin('stocks_tb','stocks_tb.stock_id','=','payable_tb.stock_id')
            ->leftjoin('project_tb','project_tb.id','=','payable_tb.project_id')
            ->leftjoin('suppliers','suppliers.id','=','payable_tb.supplier_id')
            ->select('payable_tb.*','stocks_tb.*','project_tb.name','suppliers.supplier_name')
            ->get();
        return view('stock_payable.payable',compact("getAllData"));
    }

    public function store(Request $request) {
        $inputs = [
            "stock_id" => $request->stock,
            "supplier_id" => $request->supplier,
            "project_id" => $request->project,
            "quantity" => $request->quantity,
            "account_head_id" => $request->account_head,
            "description" => $request->description,
        ];
        $getStockPrice = DB::table('stocks_tb')->select('amount')->where('stock_id',1)->first();
        $getStockPrice = $getStockPrice->amount;
        $inputs['total_amount'] = $getStockPrice * $inputs['quantity'];
        try {
            DB::begintransaction();
                DB::table('payable_tb')->insert([$inputs]);
                DB::table('warehouse_tb')->insert([
                    "project_id" => $request->project,
                    "stock_id" => $request->stock,
                    "total_quantity" => $request->quantity,
                ]);
            DB::commit();
            return redirect('/stock_payable/');
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function create() {
        $accountHead = DB::table('account_head_tb')->select("*")->where('delete_flag',0)->get();
        $getStock = DB::table('stocks_tb')->select('*')->where('delete_flag',0)->get();
        $getProject = DB::table('project_tb')->select('*')->where('delete_flag',0)->get();
        $getSupplier = DB::table('suppliers')->select("*")->where('delete_flag',0)->get();
        return view('stock_payable.create_payable',compact('accountHead','getStock','getProject','getSupplier'));
    }
    public function confirm($id) {
        try{
            DB::update('update payable_tb set confirm_flag = ?  where id = ?',[1,$id]);
            return redirect('/stock_payable/');
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function show($id) {

        $getData = DB::table('payable_tb')
            ->leftjoin('stocks_tb','stocks_tb.stock_id','=','payable_tb.stock_id')
            ->leftjoin('project_tb','project_tb.id','=','payable_tb.project_id')
            ->leftjoin('suppliers','suppliers.id','=','payable_tb.supplier_id')
            ->select('payable_tb.*','stocks_tb.*','project_tb.name','suppliers.supplier_name')
            ->where('payable_tb.id',$id)
            ->get();
        return view('stock_payable.payback_payable',compact('getData'));
    }
    public function payback(Request $request ,$id) {
        $inputs = [
            "payback_amount" => $request->payback_amount,
            "payment_type" => $request->payment_type,
        ];

        try {
            DB::beginTransaction();

            // check payable
//            $checkPayback = DB::table('payable_tb')->select('payback_amount')->where("id",$id)->where('delete_flag')->get();
//            dd($checkPayback);


            DB::update('update payable_tb set payback_amount = ?  where id = ?',[$inputs['payback_amount'],$id]);
                // to continues to keep payable detail
                DB::table('payable_detail')->insert([
                   'payable_id' => $id,
                    'payable_amount' => $inputs['payback_amount'],
                    'payment_type' => $inputs['payment_type'],
                ]);
                // to continues to keep all transaction cashbook
            DB::commit();
            return redirect('/stock_payable');
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }
    public function payback_detail($id) {
        $getData = DB::table('payable_detail')->where('payable_id',$id)->get();
        return view('stock_payable/paybale_detail',compact('getData'));
    }
}
