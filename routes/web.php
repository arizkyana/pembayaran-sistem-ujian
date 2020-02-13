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
    return redirect(route('dashboard'));
});

// Auth Routes
Route::get('/login', 'LoginController@index')->name('login:view');
Route::post('/login', 'LoginController@login')->name('login');
Route::post('/logout', 'LoginController@logout')->name('logout');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/checkout', 'CheckoutController@index')
    ->name('checkout');
Route::get('/checkout/{no_kwitansi}/upload', 'CheckoutController@uploadForm')->name('checkout:upload');
Route::post('/checkout/{no_kwitansi}/upload', 'CheckoutController@upload')->name('checkout:upload:file');
Route::get('/checkout/{no_kwitansi}/download', 'CheckoutController@download')->name('checkout:download');

Route::get('/pembayaran', 'PembayaranController@index')
    ->name('pembayaran');
Route::post('/pembayaran', 'PembayaranController@create')
    ->name('pembayaran:create');
Route::post('/pembayaran/update/all', 'PembayaranController@updateAll')
    ->name('pembayaran:update');

Route::get('/history-pembayaran', 'ProfileController@history_pembayaran')->name('profile:history-pembayaran');
Route::get('/history-pembayaran/{no_kwitansi}', 'ProfileController@detail_pembayaran')->name('profile:detail_pembayaran');
