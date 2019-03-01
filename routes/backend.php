<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "backend" middleware group. Now create something great!
|
*/
Route::get('/', [
    'as' => 'dashboard.index',
    'uses' => 'DashboardController@index'
]);
Route::resource('admin', 'AdminController');
Route::resource('customer', 'CustomerController')->only(['index', 'show', 'destroy']);
Route::post('pl-import/import', [
    'as' => 'pl.import.import',
    'uses' => 'PlImportController@import'
]);

Route::get('table-columns/{table}', [
    'as' => 'pl.import.table.columns',
    'uses' => 'PlImportController@getTableColumns'
]);
Route::resource('pl-import', 'PlImportController');

authRoutes('backend');
Route::post('/convert-media', ['as' => 'convertMedia', 'uses' => 'ConvertMediaController@convert']);
Route::post('/save-crop-tmp-file', ['as' => 'saveCropImgTmpFile', 'uses' => 'ConvertMediaController@saveCropImgTmpFile']);
//
Route::resource('applications', 'ApplicationsController')->only(['index', 'show', 'exportCsv']);
Route::get('shipping/exportCsvCongrat', [
    'as' => 'shipping.exportCsvCongrat',
    'uses' => 'ShippingController@exportCsvCongrat'
]);
Route::post('shipping/importExcel', [
    'as' => 'shipping.importExcel',
    'uses' => 'ShippingController@importExcel'
]);
Route::resource('shipping', 'ShippingController')->only(['index', 'show', 'exportCsv']);
Route::resource('presents', 'PresentsController');

Route::get('serial-numbers/gen-winners', [
    'as' => 'serial.gen.winners',
    'uses' => 'SerialNumbersController@genWinners'
]);

Route::resource('serial-numbers', 'SerialNumbersController')->only(['index', 'store', 'exportCsv'])->names('serial_numbers');
Route::post('shop/importExcel', [
    'as' => 'shop.importExcel',
    'uses' => 'ListStoreController@importExcel'
]);
Route::resource('shop', 'ListStoreController')->only(['index', 'show', 'destroy',]);
