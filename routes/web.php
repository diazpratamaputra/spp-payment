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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/spp/payment/{tahun}', 'App\Http\Controllers\HomeController@spp');

Route::get('/spp/years/{tahun}', 'App\Http\Controllers\SPPController@thn');

Route::get('/uangBangunan/payment', 'App\Http\Controllers\HomeController@uangBangunan');

Route::get('/uangBangunan/histori', 'App\Http\Controllers\HomeController@histori');

Route::post('/spp/bayar/{paraTahun}', 'App\Http\Controllers\HomeController@spppayment');

Route::get('/uangBangunan/bayar', 'App\Http\Controllers\HomeController@uangBangunanpayment');

Route::post('/uangBangunan/bayar', 'App\Http\Controllers\HomeController@uangBangunanpayment');
