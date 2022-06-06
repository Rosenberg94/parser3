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


Route::get('/', '\App\Http\Controllers\HomeController@foo')->name('foo');
Route::get('/sendjs', '\App\Http\Controllers\HomeController@sendJs')->name('send_js');
Route::post('/sendurl', '\App\Http\Controllers\ParsingController@sendUrl')->name('send_url');



