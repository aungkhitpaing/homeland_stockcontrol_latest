<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficeExpenseController extends Controller
{
	public function index() {
        
        $getAllExpenseCategories = $this->showExpenseCategory();
        
        return view('office_expense.show',compact('getAllExpenseCategories'));
    }

    public function create()
    {
    	return view('office_expense.add');
    }


    public function store(Request $request)
    {
        $storeInvestor = DB::table('office_expense_category')->insert([
        	'expense_category_code' => $request->expense_code, 
        	'expense_category_name' => $request->expense_cat_name
        ]);
        return redirect('/expense_category');
    }

    /**
     * retrieve edit investor
     *
     * @return Response
     */
    public function edit($id)
    {
        $editExpenseCategories = DB::table('office_expense_category')->where('id',$id)->get();
        return view('office_expense.edit',compact('editExpenseCategories'));
    }

    /**
     * retrieve update investor
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $updateCat = DB::table('office_expense_category')->where('id',$id)->update([
        	'expense_category_code' => $request->expense_code, 
        	'expense_category_name' => $request->expense_cat_name
        ]);
        return redirect('/expense_category');
    }

    public function delete($id)
    {
        $deleteInvestor = DB::table('office_expense_category')->where('id',$id)->update([
        	'delete_flag' => 1
        ]);
     	return redirect('/expense_category');
    }

    public function showExpenseCategory() {
        
        $getAllExpenseCategory = DB::table('office_expense_category')->where('delete_flag',0)->get();
        
        return $getAllExpenseCategory;
    }
}

?>