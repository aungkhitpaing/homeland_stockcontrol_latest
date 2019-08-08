<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeadQuaterIncomeController extends Controller
{
    //
    public function index()
    {
        return view('head_quater.income_cashbook');
    }
}
