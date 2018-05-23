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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/viewRequests', 'ServiceRequestController@allServiceRequests');
Route::get('/confirm/{serviceIDNo}', 'ServiceRequestController@confirmRequest');
Route::get('/view_order/{serviceIDNo}', 'ServiceRequestController@viewOrder');
Route::get('/checkInvoice/{service_id}', 'ServiceRequestController@checkInvoice');
Route::post('/timeIn', 'ServiceRequestController@timeIn');
Route::post('/timeOut', 'ServiceRequestController@timeOut');
Route::get('/approveInvoice/{serviceIDNo}', 'ServiceRequestController@approveInvoice');
