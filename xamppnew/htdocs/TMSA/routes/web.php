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


Route::post('/createNewUser', 'UserManagementController@createNewUser');
Route::get('/viewOrders', 'ServiceRequestController@showAllForCustomer');
Route::get('/viewOrderDetails/{serviceIDNo}', 'ServiceRequestController@viewOrderDetails');
Route::get('/searchResources/{serviceIDNo}', 'ServiceRequestController@searchResources');
Route::get('/viewResource/{resource_id}', 'ServiceRequestController@viewResource');
Route::post('/sendHaulageRequest', 'ServiceRequestController@sendHaulageRequest');
Route::get('/createInvoiceForCarrier/{serviceIDNo}', 'ServiceRequestController@createInvoiceForCarrier');
Route::get('/createInvoiceForClient/{serviceIDNo}', 'ServiceRequestController@createInvoiceForClient');
Route::get('/carrierProceed/{id}', 'ServiceRequestController@carrierProceed');
Route::get('/viewAllResources', 'ReportController@viewAllResources');
Route::get('/viewAllUsers', 'ReportController@allUsers');
