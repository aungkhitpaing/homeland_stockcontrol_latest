<?php

namespace App\Http\Controllers;

use App\Estimate;
use App\Supplier;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('project.index');
    }

    public function estimate()
    {
        $estimates = Estimate::paginate(5);
        return view('project.estimate', compact('estimates'));
    }

    public function estimateCreate()
    {
        return view('project.estimate_create');
    }

    public function estimateEdit()
    {
        return view('project.estimate_edit');
    }

    public function DailyExpense()
    {
        return view('project.daily_expense');
    }
    public function getAllDailyExpense()
    {
        return view('project.get_all_daily_expense');
    }

    public function Supplier()
    {
        $suppliers = Supplier::paginate(15);
        return view('project.supplier', compact('suppliers'));
    }

    public function supplierCreate()
    {
        return view('project.supplier_create');
    }

    public function supplierEdit()
    {
        return view('project.supplier_edit');
    }

    public function stockControl()
    {
        dd('hello');
    }
}
