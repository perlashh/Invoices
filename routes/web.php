<?php

use Illuminate\Support\Facades\Route;

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
   // return view('welcome');
  return view('auth.login');
});

//Auth::routes(['register' => false]);
Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();
Route::resource('invoices', 'App\Http\Controllers\InvoicesController');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('archives', 'App\Http\Controllers\InvoicesArchivesController');
Route::resource('sections', 'App\Http\Controllers\SectionsController');
Route::resource('productss', 'App\Http\Controllers\ProductsController');
Route::resource('InvoiceAttachments', 'App\Http\Controllers\InvoicesAttachmentsController');
Route::get('section/{id}', 'App\Http\Controllers\InvoicesController@getproducts');
Route::get('InvoicesDetails/{id}', 'App\Http\Controllers\InvoicesDetailsController@edit');

Route::get('InvoicesDetailsarch/{id}' ,'App\Http\Controllers\InvoicesDetailsController@editarch');
Route::get('View_file/{invoice_number}/{file_name}' ,'App\Http\Controllers\InvoicesDetailsController@openfile');
Route::get('download/{invoice_number}/{file_name}' ,'App\Http\Controllers\InvoicesDetailsController@getfile');
Route::post('DeleteFile' ,'App\Http\Controllers\InvoicesDetailsController@destroy')->name('DeleteFile');
//Route::post('invoic' ,'App\Http\Controllers\InvoicesDetailsController');
Route::get('updat_invoice/{id}','App\Http\Controllers\InvoicesController@updat');
Route::get('edit_invoice/{id}','App\Http\Controllers\InvoicesController@edit');
Route::post('update_status/{id}','App\Http\Controllers\InvoicesController@up_status');
Route::get('paid_ivoices','App\Http\Controllers\InvoicesController@paid');
Route::get('unpaid_invoices','App\Http\Controllers\InvoicesController@unpaid');
Route::get('partlypaid_invoices','App\Http\Controllers\InvoicesController@partlypaid');
Route::get('print_invoice/{id}','App\Http\Controllers\InvoicesController@printinvoice');


Route::get('export_invoice', 'App\Http\Controllers\InvoicesController@export');
Route::resource('invoicereport', 'App\Http\Controllers\InvoiceReportController');
Route::get('search_invoices' , 'App\Http\Controllers\InvoiceReportController@show');
Route::resource('customer_report', 'App\Http\Controllers\CustomerReportController');
Route::get('search_invoicescustomer' ,'App\Http\Controllers\CustomerReportController@show');
Route::group(['middleware' => ['auth']], function() {

  Route::resource('roles','App\Http\Controllers\RoleController');

  Route::resource('users','App\Http\Controllers\UserController');

 
});

Route::get('MarkAsReadAll', 'App\Http\Controllers\InvoicesController@MarkAsRead_all');
Route::get('/{page}', 'App\Http\Controllers\AdminController@index');

