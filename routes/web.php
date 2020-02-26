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
    return view('welcome');
});



Route::group(['middleware'=>'preventbackbutton'],function(){
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('dropdownlist/getdesignation/{id}','DependentDropdown@getdesignation');
    Route::post('/registered','EmployeeRegistration@saveData')->name('employeeregistration');
    Route::post('/home','EmployeeLogincontroller@login')->name('Employeelogin');
});