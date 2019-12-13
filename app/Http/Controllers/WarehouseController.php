<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class WarehouseController extends Controller
{
    /**
     * show all list for main
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $getAllData = DB::table('warehouse_tb as w')
            ->join('stocks_tb as s','s.stock_id','=','w.stock_id')
            ->join('project_tb as p','p.id','=','w.project_id')
            ->select('w.id','w.total_quantity','w.created_at','w.used_quantity','s.stock_name','s.unit','p.name')
            ->where('w.delete_flag',0)->get();

        return view('warehouse.warehouselists',compact('getAllData'));
    }

    /**
     * show detail for instock and outstock
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        $getLastUrl = last(request()->segments());
        $getAllData = DB::table('stock_warehouse_detail')
            ->join('warehouse_tb as w','w.id','=','stock_warehouse_detail.warehouse_id')
            ->join('stocks_tb as s','s.stock_id','=','stock_warehouse_detail.stock_id')
            ->select('stock_warehouse_detail.*','s.stock_name','s.unit');
        if($getLastUrl == "outstock_detail")
        {
            $getAllData ->where('stock_warehouse_detail.warehouse_id',$id)->whereNotNull('outstock_amount');
        } else {

            $getAllData->where('stock_warehouse_detail.warehouse_id',$id)->whereNotNull('instock_amount');
        }
        $getAllData = $getAllData->get();
        return view('warehouse.warehouseDetails',compact('getAllData','getLastUrl'));
    }


    public function add_outstock($id) {
        $getTotal = DB::table('warehouse_tb')->select("*")->where('id',$id)->first();
        $getProject = DB::table('project_tb')->where('id','!=',$getTotal->project_id)->get();
        $warehouse_id = $id;
        return view('warehouse.add_outstock',compact('getProject','getTotal','warehouse_id'));
    }

    public function create_outstock(Request $request,$id) {

        $inputs = $request->all();
        $outtingType = $inputs['outting_type'];
        if ($outtingType == 2) {
            $checkExchangeProj = DB::table('warehouse_tb')->where('project_id', $inputs['project'])->exists();
            if ($checkExchangeProj) {
                try {
                    DB::beginTransaction();
                    $fromProject = DB::table('warehouse_tb')->select('project_id')->where('id', $id)->first();
                    $outStock = $inputs['outstock'];
                    $getCurrentOutstock = DB::table('warehouse_tb')
                        ->select('total_quantity', 'id', 'project_id')
                        ->where('project_id', $inputs['project'])
                        ->where('stock_id', $inputs['stockId'])
                        ->first();
                    $updateCurrentOutstock = $getCurrentOutstock->total_quantity + $outStock;
                    DB::update('update warehouse_tb set total_quantity = ?  where id = ?', [$updateCurrentOutstock, $getCurrentOutstock->id]);
                    $exchange_from = $this->getProject($fromProject->project_id);
                    $exchange_to =  $this->getProject($inputs['project']);
                    DB::table('stock_warehouse_detail')->insert([
                        "warehouse_id" => $getCurrentOutstock->id,
                        "stock_id" => $inputs['stockId'],
                        "instock_amount" => $inputs['outstock'],
                        "exchange_flag" => 1,
                        "exchange_from" => $fromProject->project_id,
                        "description" => $inputs['description'] . " / Receive From ->  ". $exchange_from ,
                    ]);
                    DB::table('stock_warehouse_detail')->insert([
                        "warehouse_id" => $id,
                        "stock_id" => $inputs['stockId'],
                        "outstock_amount" => $inputs['outstock'],
                        "exchange_flag" => 1,
                        "exchange_to" => $inputs['project'],
                        "description" => $inputs['description'] . " / Give To -> ".$exchange_to,
                    ]);
                    // update previous warehouse
                    $getAllOutstockQty = DB::table('stock_warehouse_detail')->select('*')
                        ->where('warehouse_id', $id)
                        ->where('stock_id', $inputs['stockId'])
                        ->whereNotNull('outstock_amount')
                        ->get()->toArray();


                    if (!empty($getAllOutstockQty)) {
                        // add sum
                        $outstockQtyArr = [];
                        foreach ($getAllOutstockQty as $getOutstockQty) {
                            array_push($outstockQtyArr, $getOutstockQty->outstock_amount);
                        }
                        $getTotalUsedStockQty = array_sum($outstockQtyArr);

                    } else {
                        $getTotalUsedStockQty = $inputs['outstock'];
                    }

                    DB::update('update warehouse_tb set used_quantity = ?  where id = ?', [$getTotalUsedStockQty, $id]);


                    DB::commit();

                } catch (\Exception $exception) {
                    DB::rollBack();
                    return $exception->getMessage();
                }
            } else {
                // When Exchange project isn't exist ,
                try {
                    DB::beginTransaction();
                    // exchange stock are created.
                    DB::table('warehouse_tb')->insert([
                        "project_id" => $inputs['project'],
                        "stock_id" => $inputs['stockId'],
                        "total_quantity" => $inputs['outstock'],
                    ]);
                    $createdWarehouseId = DB::getPdo()->lastInsertId();
                    // increase stock in stock ware house detail for exchange warehouse
                    $fromProject = DB::table('warehouse_tb')->select('project_id')->where('id', $id)->first();
                    $exchange_from = $this->getProject($fromProject->project_id);
                    $exchange_to =  $this->getProject($inputs['project']);
                    // reduce stock in stock ware house detail for prev warehouse
                    DB::table('stock_warehouse_detail')->insert([
                        "warehouse_id" => $id,
                        "stock_id" => $inputs['stockId'],
                        "outstock_amount" => $inputs['outstock'],
                        "exchange_flag" => 1,
                        "exchange_to" => $inputs['project'],
                        "description" => $inputs['description'] . " / Give To -> ". $exchange_to,
                    ]);

                    // update previous warehouse
                    $getAllOutstockQty = DB::table('stock_warehouse_detail')->select('*')
                        ->where('warehouse_id', $id)
                        ->where('stock_id', $inputs['stockId'])
                        ->whereNotNull('outstock_amount')
                        ->get()->toArray();


                    if (!empty($getAllOutstockQty)) {
                        // add sum
                        $outstockQtyArr = [];
                        foreach ($getAllOutstockQty as $getOutstockQty) {
                            array_push($outstockQtyArr, $getOutstockQty->outstock_amount);
                        }
                        $getTotalUsedStockQty = array_sum($outstockQtyArr);

                    } else {
                        $getTotalUsedStockQty = $inputs['outstock'];
                    }

                    DB::update('update warehouse_tb set used_quantity = ?  where id = ?', [$getTotalUsedStockQty, $id]);

                    DB::table('stock_warehouse_detail')->insert([
                        "warehouse_id" => $createdWarehouseId,
                        "stock_id" => $inputs['stockId'],
                        "instock_amount" => $inputs['outstock'],
                        "exchange_flag" => 1,
                        "exchange_from" => $fromProject->project_id,
                        "description" => $inputs['description'] . " / Receive  From ->  ".$exchange_from,
                    ]);

                    DB::commit();
                } catch (\Exception $exception) {
                    DB::rollBack();
                    return $exception->getMessage();
                }
            }
        } else {
            // normal
            $outstock = [
                'warehouse_id' => $id,
                'stock_id' => $inputs['stockId'],
                'outstock_amount' => $inputs['outstock'],
                'description' => $inputs['description'],
            ];
            try {
                DB::beginTransaction();
                DB::table('stock_warehouse_detail')->insert($outstock);

                $getAllOutstockQty = DB::table('stock_warehouse_detail')->select('outstock_amount')
                    ->where('warehouse_id',$id)
                    ->where('stock_id',$request->stockId)
                    ->whereNotNull('outstock_amount')
                    ->get()->toArray();
                $outstockQtyArr = [];
                foreach ($getAllOutstockQty as $getOutstockQty) {
                    array_push($outstockQtyArr,$getOutstockQty->outstock_amount);
                }
                if(!empty($getAllOutstockQty)) {

                    $getTotalUsedStockQty = array_sum($outstockQtyArr);
                    DB::update('update warehouse_tb set used_quantity = ?  where id = ?',[$getTotalUsedStockQty, $id]);
                }
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                return $exception->getMessage();
            }
        }
        return redirect('/warehouse/');
    }

    public function getProject ($project_id) {

        $project = DB::table('project_tb as p')->select('name')
            ->where('p.id','=',$project_id)->get()->toArray();
        return $project[0]->name;
    }
}
