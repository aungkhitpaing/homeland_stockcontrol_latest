<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $stocks = \DB::table('stocks_tb')->paginate(15);
        return view('stock.index', compact('stocks'));
    }

    public function create()
    {
        return view('stock.create');
    }

    public function edit($id)
    {
        $stock = \DB::table('stocks_tb')->where('id',$id)->first();
        return view('stock.edit',compact('stock'));
    }

    public function store()
    {
        \DB::table('stocks_tb')->insert([
            'stock_name' => request()->stock_name,
            'unit' => request()->unit,
            'project_id' => request()->project_id,
            'amount' => request()->amount
        ]);
        return redirect('/stock');
    }

    public function update($id)
    {
        \DB::table('stocks_tb')->where('id',$id)->update([
            'stock_name' => request()->stock_name,
            'unit' => request()->unit,
            'project_id' => request()->project_id,
            'amount' => request()->amount
        ]);
        return redirect('/stock');

    }

    public function destroy($id)
    {
        \DB::table('stocks_tb')->where('id',$id)->delete();
        return redirect('/stock');

    }

}
