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
Route::post('login','Api\LoginController@login');
Route::get('getholiday','Api\GetHolidays@getHolidays');
Route::post('applyLeave','Api\RequestLeave@submitRequest');




