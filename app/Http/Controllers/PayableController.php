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
            ->select('payable_tb.*','stocks_tb.unit','stocks_tb.stock_name','stocks_tb.amount','project_tb.name','suppliers.supplier_name')
            ->where('payable_tb.delete_flag',0)
            ->get();
        return view('stock_payable.payable',compact("getAllData"));
    }

    public function store($inputs) {

//        $inputs = [
//            "stock_id" => $request->stock,
//            "supplier_id" => $request->supplier,
//            "project_id" => $request->project,
//            "quantity" => $request->quantity,
//            "account_head_id" => $request->account_head,
//            "description" => $request->description,
//        ];
        $getStockPrice = DB::table('stocks_tb')->select('amount')->where('stock_id',$inputs['stock_id'])->first();

        $getStockPrice = $getStockPrice->amount;
        $inputs['total_amount'] = $getStockPrice * $inputs['quantity'];

        try {
            DB::begintransaction();
                DB::table('payable_tb')->insert([$inputs]);
                $checkRow = DB::table('warehouse_tb')
                    ->where('project_id','=',$inputs['project_id'])
                    ->where('stock_id','=',$inputs['stock_id'])
                    ->exists();
                $getId = DB::table('warehouse_tb')->select('*')
                    ->where('project_id','=',$inputs['project_id'])
                    ->where('stock_id','=',$inputs['stock_id'])
                    ->first();
                if ($checkRow == true ) {
                    $total_quantity = $getId->total_quantity + $inputs['quantity'];
                    DB::update('update warehouse_tb set total_quantity = ?  where id = ?',[$total_quantity,$getId->id]);
                    $warehouseId = $getId->id;
                } else {
                    DB::table('warehouse_tb')->insert([
                        "project_id" => $inputs['project_id'],
                        "stock_id" => $inputs['stock_id'],
                        "total_quantity" => $inputs['quantity'],
                    ]);
                    $warehouseId = DB::getPdo()->lastInsertId();
                }
                DB::table('stock_warehouse_detail')->insert([
                    "warehouse_id" => $warehouseId,
                    "stock_id" => $inputs['stock_id'],
                    "instock_amount" => $inputs['quantity'],
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
            ->select('payable_tb.*',
                'stocks_tb.stock_id',
                'stocks_tb.stock_name',
                'stocks_tb.unit',
                'stocks_tb.amount',
                'project_tb.name',
                'suppliers.supplier_name')
            ->where('payable_tb.id',$id)
            ->get();
        $getTotalPayback = DB::table('payable_detail')
            ->where('payable_id',$id)
            ->select('payable_id', \DB::raw('SUM(payable_amount) as total_amount'))
            ->groupBy('payable_id')
            ->get()->toArray();
        if(!empty($getTotalPayback)) {
            $totalPayback = $getTotalPayback[0]->total_amount;
        } else {
            $totalPayback = 0;
        }

        return view('stock_payable.payback_payable',compact('getData','totalPayback'));
    }
    public function payback(Request $request ,$id) {
        $inputs = [
            "payback_amount" => $request->payback_amount,
            "payment_type" => $request->payment_type,
        ];

        try {
            DB::beginTransaction();

            // check payable
            $checkPayback = DB::table('payable_tb')->select('payback_amount')->where("id",$id)->where('delete_flag',0)->get();
            $checkPayback = $checkPayback[0]->payback_amount;

            if(!empty($checkPayback)){
                $increasePayback = $checkPayback + $inputs['payback_amount'];
                DB::update('update payable_tb set payback_amount = ?  where id = ?',[$increasePayback,$id]);
            } else {
                DB::update('update payable_tb set payback_amount = ?  where id = ?',[$inputs['payback_amount'],$id]);
            }

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

    public function delete($id) {
        DB::update('update payable_tb set delete_flag = ?  where id = ?',[1,$id]);
        return redirect('/stock_payable/');
    }
}
