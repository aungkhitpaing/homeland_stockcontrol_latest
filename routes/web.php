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
Route::get('/record_histories', 'RecordHistoryController@index');
Route::post('/record_histories/excel', 'RecordHistoryController@excelExport');
Route::get('log-out','DashBoardController@logout');

Route::prefix('head_quater')->group(function () {
	// Route::post('/login',function(){
	// 	return view('authentication.login');
	// });
	// Route::get('/opening_amounts',function(){
	// 	return view('head_quater.cash_bank');
	// });
	Route::get('/create', 'HeadQuaterIncomeController@create');

    Route::get('/receive_paymentorder/{id}','HeadQuaterIncomeController@ReceivePaymentOrder');

    /**
     * Investor
     */
	Route::get('/invester_detail/{id}', 'HeadQuaterIncomeController@getAllInvestorIncomeById');
	Route::get('{invester_id}/invester_detail/{id}/edit', 'HeadQuaterIncomeController@EditInvestorIncomeById');
	Route::patch('{invester_id}/invester_detail/{id}', 'HeadQuaterIncomeController@UpdateInvestorIncomeById');

    /**
     * Project
     */
	Route::get('/project_detail/{id}', 'HeadQuaterIncomeController@getAllProjectIncomeById');
    Route::get('{project_id}/project_detail/{id}/edit', 'HeadQuaterIncomeController@EditProjectIncomeById');
    Route::patch('{project_id}/project_detail/{id}', 'HeadQuaterIncomeController@UpdateProjectIncomeById');

    /**
     * Bank
     */
	Route::get('/bank_detail/{id}', 'HeadQuaterIncomeController@getAllBankIncomeById');
    Route::get('/loan_detail/{loan_id}/edit', 'HeadQuaterIncomeController@EditBankIncomeById');
    Route::get('/loan_detail/{loan_id}/delete', 'HeadQuaterIncomeController@DeleteBankIncomeById');
    Route::patch('/loan_detail/{loan_id}', 'HeadQuaterIncomeController@UpdateBankIncomeById');
//    Route::get('{bank_detail_id}/loan_detail/{loan_id}/edit', 'HeadQuaterIncomeController@EditBankIncomeById');
//    Route::patch('{bank_detail_id}/loan_detail/{loan_id}', 'HeadQuaterIncomeController@UpdateBankIncomeById');

    /**
     * purchase order
     */
	Route::get('/payment_order_detail/{id}', 'HeadQuaterIncomeController@getAllPaymentOrderIncomeById');
    Route::get('{payment_order_id}/payment_order_detail/{id}/edit', 'HeadQuaterIncomeController@EditPOIncomeById');
    Route::patch('{payment_order_id}/payment_order_detail/{id}', 'HeadQuaterIncomeController@UpdatePOIncomeById');



    /**
     * purchase guarantee
     */
	Route::get('/purchase_guarantee_detail/{id}', 'HeadQuaterIncomeController@getAllPurchaseGuaranteeIncomeById');
    Route::get('{purchase_guarantee_id}/purchase_guarantee_detail/{id}/edit', 'HeadQuaterIncomeController@EditPGIncomeById');
    Route::patch('{purchase_guarantee_id}/purchase_guarantee_detail/{id}', 'HeadQuaterIncomeController@UpdateExpendById');


    /**
     * Update and Edit Expense for all
     */


    /**
     * Office expenses or Daily Expenses
     */
    Route::get('/office_expense_detail/expense_cat/{id}', 'HeadQuaterExpandController@getAllOfficeExpenseByExpenseCatId');
    Route::get('/office_expense_detail/project/{id}', 'HeadQuaterExpandController@getAllOfficeExpenseByProjectId');
    Route::get('/office_expense_detail/{id}/edit', 'HeadQuaterExpandController@EditExpenseById');
    Route::patch('/office_expense_detail/{id}', 'HeadQuaterExpandController@UpdateExpendById');


    /**
     * Project Expenses
     */
    Route::get('/project_expense_detail/{id}', 'HeadQuaterExpandController@getAllProjectExpenseByProjectId');
    Route::get('/project_expense_detail/{id}/edit', 'HeadQuaterExpandController@EditExpenseById');
    Route::patch('/project_expense_detail/{id}/update', 'HeadQuaterExpandController@UpdateExpendById');


    /**
     * Bank Expensee
     */
    Route::get('/bank_expense_detail/{id}/edit', 'HeadQuaterExpandController@EditExpenseById');
    Route::patch('/bank_expense_detail/{id}/update', 'HeadQuaterExpandController@UpdateExpendById');




	Route::get('/income_cashbook', 'HeadQuaterIncomeController@index');
	Route::post('/storeInvestorIncome', 'HeadQuaterIncomeController@storeInvestorIncome');
	Route::post('/storeProjectIncome', 'HeadQuaterIncomeController@storeProjectIncome');
	Route::post('/storeBankIncome', 'HeadQuaterIncomeController@storeBankIncome');
	Route::post('/storePaymentOrderIncome', 'HeadQuaterIncomeController@storePaymentOrderIncome');
	Route::post('/storePurchaseGuaranteeIncome', 'HeadQuaterIncomeController@storePurchaseGuaranteeIncome');

    /**
     * Tinder Registeration
     */
	Route::post('tinder_registeration','HeadQuaterIncomeController@storeTinderRegister');
	Route::get('tinder_registeration/{id}','HeadQuaterIncomeController@getTinderRegisterById');
    Route::get('tinder_registeration/{id}/edit','HeadQuaterIncomeController@editTinderRegisterById');
    Route::patch('tinder_registeration/payback/{id}/update','HeadQuaterIncomeController@updateTinderRegisterById');
	Route::Post('tinder_registeration/payback/{id}','HeadQuaterIncomeController@paybackTinder');
    Route::get('tinder_registeration/payback/{id}','HeadQuaterIncomeController@getAllDetailPaybackTinder');



	Route::get('/alltransaction', 'CashBookController@index');
	Route::post('/alltransaction/excel', 'CashBookController@excelExport');


	// Route::post('/create_investor_income','HeadQuaterIncomeController@storeInvestorIncome');

	Route::post('/storeDailyExpend', 'HeadQuaterExpandController@storeDailyExpend');
	Route::post('/storeProjectExpend', 'HeadQuaterExpandController@storeProjectExpend');
	Route::post('/storeBankExpense', 'HeadQuaterExpandController@storeBankExpense');
	Route::post('/storePaymentOrderExpend','HeadQuaterExpandController@storePaymentOrderExpend');

	Route::get('/expend_cashbook', 'HeadQuaterExpandController@index');
	Route::get('/add_expend', 'HeadQuaterExpandController@create');
	Route::get('/add_expend/bank/{id}','HeadQuaterExpandController@createBankLoan');
    Route::get('/loan_detail/{loan_id}/show', 'HeadQuaterExpandController@getBankExpenseById');


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

/* ExchangeController */
Route::prefix('exchange_transfer')->group(function () {
	Route::get('/', 'ExchangeController@index');
	Route::get('/create', 'ExchangeController@create');
	Route::post('/store', 'ExchangeController@exchangeCalculate');
	Route::get('/{id}/edit', 'ExchangeController@edit');
	Route::patch('{id}/update', 'ExchangeController@update');
	Route::get('{id}/delete', 'ExchangeController@delete');
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






Route::get('/estimate', 'ProjectController@estimate');
Route::get('/estimate/create', 'ProjectController@estimateCreate');
Route::get('/estimate/edit', 'ProjectController@estimateEdit');

Route::get('/dailyexpense', 'ProjectController@getAllDailyExpense');
Route::get('/createdailyexpense', 'ProjectController@dailyexpense');
Route::get('/dailyexpense/detail', function () {
	return view('project.detail_dailyexpense');
});



Route::get('/stock-control', 'ProjectController@stockControl');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/project-expense','ProjectExpenseController@index');
Route::get('/project-expense','ProjectExpenseController@index');
Route::post('/project-expense','ProjectExpenseController@store');
Route::get('/project-expense/{id}/edit','ProjectExpenseController@edit');
Route::post('/project-expense/{id}/update','ProjectExpenseController@update');
Route::get('/project-expense/{id}/record','ProjectExpenseController@record');



Route::get('/project-order','ProjectOrderController@index');
Route::get('/project-order/stock_price/{stock}','ProjectOrderController@getStockPrice');
Route::post('/project-order','ProjectOrderController@store');


Route::get('/project-user','ProjectUserController@index');
Route::post('/project-user','ProjectUserController@store');
Route::post('/project-user/{id}/delete','ProjectUserController@destroy');

Route::get('/supplier','SupplierController@index');
Route::post('/supplier','SupplierController@store');
Route::get('/supplier/{id}/edit','SupplierController@edit');
Route::post('/supplier/{id}/update','SupplierController@update');
Route::post('/supplier/{id}/delete','SupplierController@destroy');



Route::get('custom-logout','HomeController@logout');

Route::get('have-not-permission','HomeController@haveNotPermission');

