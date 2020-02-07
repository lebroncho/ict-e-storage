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
    return view('home');
});

Route::resource('memo', 'MemoController');

Route::resource('request', 'RequestController');
Route::put('request/{request}', 'RequestController@replaceImage')->name('request.replaceImage');

Route::resource('purchase_order', 'PoController');

Route::resource('requisition', 'RequisitionController');

Route::resource('bill', 'BillController');

Route::resource('other', 'OtherController');

Route::resource('requisition_item', 'RequisitionItemController');

Route::resource('po_item', 'PoItemController');

