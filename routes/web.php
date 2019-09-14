<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('authentication.login');
});

Route::get('/admin_dashboard', 'DashBoardController@index');

Route::prefix('head_quater')->group(function () {
	// Route::post('/login',function(){
	// 	return view('authentication.login');
	// });
	// Route::get('/opening_amounts',function(){
	// 	return view('head_quater.cash_bank');
	// });
	Route::get('/create', 'HeadQuaterIncomeController@create');

	Route::get('/invester_detail/{id}', 'HeadQuaterIncomeController@getAllInvestorIncomeById');
	Route::get('/project_detail/{id}', 'HeadQuaterIncomeController@getAllProjectIncomeById');
	Route::get('/bank_detail/{id}', 'HeadQuaterIncomeController@getAllBankIncomeById');
	Route::get('/payment_order_detail/{id}', 'HeadQuaterIncomeController@getAllPaymentOrderIncomeById');
	Route::get('/purchase_guarantee_detail/{id}', 'HeadQuaterIncomeController@getAllPurchaseGuaranteeIncomeById');



	Route::get('/income_cashbook', 'HeadQuaterIncomeController@index');

	Route::post('/storeInvestorIncome', 'HeadQuaterIncomeController@storeInvestorIncome');
	Route::post('/storeProjectIncome', 'HeadQuaterIncomeController@storeProjectIncome');
	Route::post('/storeBankIncome', 'HeadQuaterIncomeController@storeBankIncome');
	Route::post('/storePaymentOrderIncome', 'HeadQuaterIncomeController@storePaymentOrderIncome');
	Route::post('/storePurchaseGuaranteeIncome', 'HeadQuaterIncomeController@storePurchaseGuaranteeIncome');


	Route::get('/alltransaction', 'CashBookController@index');
	Route::post('/alltransaction/excel', 'CashBookController@excelExport');


	// Route::post('/create_investor_income','HeadQuaterIncomeController@storeInvestorIncome');

	Route::post('/storeDailyExpend', 'HeadQuaterExpandController@storeDailyExpend');
	Route::post('/storeProjectExpend', 'HeadQuaterExpandController@storeProjectExpend');
	Route::post('/storeBankExpense', 'HeadQuaterExpandController@storeBankExpense');


	Route::get('/expend_cashbook', 'HeadQuaterExpandController@index');
	Route::get('/add_expend', 'HeadQuaterExpandController@create');

	Route::get('/office_expense_detail/expense_cat/{id}', 'HeadQuaterExpandController@getAllOfficeExpenseByExpenseCatId');
	Route::get('/office_expense_detail/project/{id}', 'HeadQuaterExpandController@getAllOfficeExpenseByProjectId');
	Route::get('/project_expense_detail/{id}', 'HeadQuaterExpandController@getAllProjectExpenseByProjectId');
});

/* Investor */
Route::prefix('investor')->group(function () {
	Route::get('/', 'InvesterController@index');
	Route::get('/create', 'InvesterController@create');
	Route::post('/store', 'InvesterController@store');
	Route::get('/{id}/edit', 'InvesterController@edit');
	Route::patch('{id}/update', 'InvesterController@update');
	Route::get('{id}/delete', 'InvesterController@delete');
});

/* Project */
Route::prefix('project')->group(function () {
	Route::get('/', 'ProjectController@index');
	Route::get('/create', 'ProjectController@create');
	Route::post('/store', 'ProjectController@store');
	Route::get('/{id}/edit', 'ProjectController@edit');
	Route::patch('{id}/update', 'ProjectController@update');
	Route::get('{id}/delete', 'ProjectController@delete');
});

/* Bank */

Route::prefix('bank')->group(function () {
	Route::get('/', 'BankController@index');
	Route::get('/create', 'BankController@create');
	Route::post('/store', 'BankController@store');
	Route::get('/{id}/edit', 'BankController@edit');
	Route::patch('{id}/update', 'BankController@update');
	Route::get('{id}/delete', 'BankController@delete');
});


/* payment order */

Route::prefix('payment_order')->group(function () {
	Route::get('/', 'PaymentOrderController@index');
	Route::get('/create', 'PaymentOrderController@create');
	Route::post('/store', 'PaymentOrderController@store');
	Route::get('/{id}/edit', 'PaymentOrderController@edit');
	Route::patch('{id}/update', 'PaymentOrderController@update');
	Route::get('{id}/delete', 'PaymentOrderController@delete');
});


/* purchase guarantee order */
Route::prefix('purchase_guarantee')->group(function () {
	Route::get('/', 'PurchaseGuaranteeController@index');
	Route::get('/create', 'PurchaseGuaranteeController@create');
	Route::post('/store', 'PurchaseGuaranteeController@store');
	Route::get('/{id}/edit', 'PurchaseGuaranteeController@edit');
	Route::patch('{id}/update', 'PurchaseGuaranteeController@update');
	Route::get('{id}/delete', 'PurchaseGuaranteeController@delete');
});


/* Account Head */

Route::prefix('accounthead')->group(function () {
	Route::get('/', 'AccountHeadController@index');
	Route::get('/create', 'AccountHeadController@create');
	Route::post('/store', 'AccountHeadController@store');
	Route::get('/{id}/edit', 'AccountHeadController@edit');
	Route::patch('/{id}/update', 'AccountHeadController@update');
	Route::get('/{id}/delete', 'AccountHeadController@delete');
});

/* expense_category */

Route::prefix('expense_category')->group(function () {
	Route::get('/', 'OfficeExpenseController@index');
	Route::get('/create', 'OfficeExpenseController@create');
	Route::post('/store', 'OfficeExpenseController@store');
	Route::get('/{id}/edit', 'OfficeExpenseController@edit');
	Route::patch('/{id}/update', 'OfficeExpenseController@update');
	Route::get('/{id}/delete', 'OfficeExpenseController@delete');
});

/* Stock */
Route::prefix('stock')->group(function () {
	Route::get('/', 'StockController@index');
	Route::get('/create', 'StockController@create');
	Route::get('/edit', 'StockController@edit');
});



/* Bank */
Route::prefix('bank')->group(function () {
	Route::get('/add', function () {
		return view('bank.add');
	});
	Route::get('/loan_detail', function () {
		return view('bank.loan_detail');
	});
});

/* Supplier */
Route::prefix('supplier')->group(function () {
	Route::get('/add', function () {
		return view('supplier.add');
	});
});





Route::get('/estimate', 'ProjectController@estimate');
Route::get('/estimate/create', 'ProjectController@estimateCreate');
Route::get('/estimate/edit', 'ProjectController@estimateEdit');

Route::get('/dailyexpense', 'ProjectController@getAllDailyExpense');
Route::get('/createdailyexpense', 'ProjectController@dailyexpense');
Route::get('/dailyexpense/detail', function () {
	return view('project.detail_dailyexpense');
});


Route::get('/supplier', 'ProjectController@supplier');
Route::get('/supplier/create', 'ProjectController@supplierCreate');
Route::get('/supplier/edit', 'ProjectController@supplierEdit');



Route::get('/stock-control', 'ProjectController@stockControl');
