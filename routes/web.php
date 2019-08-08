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

Route::get('/',function(){
	return view('authentication.login');
});

Route::get('/admin_dashboard', 'DashBoardController@index');

Route::prefix('investor')->group(function(){
	Route::get('/show',function(){
		return view('investor.show');
	});
	Route::get('/add',function(){
		return view('investor.add');
	});
	Route::post('/update',function(){
		return view('investor.edit');
	});
});

Route::prefix('head_quater')->group(function () {
	Route::post('/login',function(){
		return view('authentication.login');
	});
	Route::get('/opening_amounts',function(){
		return view('head_quater.cash_bank');
	});

	Route::get('/invester_detail/{investor_id}',function(){
		return view('head_quater.invester_detail');
	});
	Route::get('/income_cashbook', function () {
		return view('head_quater.income_cashbook');
	});
	Route::get('/add_income', function () {
		return view('head_quater.add_income');
	});
	Route::get('/expend_cashbook', function () {
		return view('head_quater.expend_cashbook');
	});
	Route::get('/add_expend', function () {
		return view('head_quater.add_expend');
	});
});

Route::prefix('stock')->group(function(){
	Route::get('/', 'StockController@index');
	Route::get('/create', 'StockController@create');
	Route::get('/edit', 'StockController@edit');
});

Route::prefix('project')->group(function(){
	Route::get('/', 'ProjectController@index');
	Route::get('/project', 'ProjectController@index');
	Route::get('/add',function(){
		return view('project.add');
	});
	Route::get('/project_income_details',function(){
		return view('project.proj_income_details');
	});
});



Route::get('/estimate', 'ProjectController@estimate');
Route::get('/estimate/create', 'ProjectController@estimateCreate');
Route::get('/estimate/edit', 'ProjectController@estimateEdit');

Route::get('/dailyexpense', 'ProjectController@getAllDailyExpense');
Route::get('/createdailyexpense','ProjectController@dailyexpense');
Route::get('/dailyexpense/detail', function(){
	return view('project.detail_dailyexpense');
});


Route::get('/supplier', 'ProjectController@supplier');
Route::get('/supplier/create', 'ProjectController@supplierCreate');
Route::get('/supplier/edit', 'ProjectController@supplierEdit');



Route::get('/stock-control', 'ProjectController@stockControl');


