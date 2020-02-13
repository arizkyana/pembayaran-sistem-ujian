<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/pembayaran', 'Api\PembayaranController@list_pembayaran')->name('list:pembayaran');
Route::get('/pembayaran/semester', 'Api\PembayaranController@list_semester')->name('list:pembayaran:semester');

Route::post('/pembayaran', 'Api\PembayaranController@add_pembayaran')->name('add:pembayaran');

Route::delete('/pembayaran/{id}', 'Api\PembayaranController@remove')->name('remove:pembayaran');
