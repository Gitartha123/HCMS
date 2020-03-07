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

Auth::routes(['verify'=>true]);
Route::get('/action','ViewEmployee@Action')->name('action');
Route::get('users', ['uses'=>'ViewEmployee@index', 'as'=>'users.index']);
Route::post('/submission','EmployeeRecordSubmit@FinalSubmit')->name('submission');
Route::get('/registered','EmployeeRecordSubmit@FinalSubmit')->name('employeeregistration');
Route::post('/registered','EmployeeRegistration@saveData')->name('employeeregistration');
Route::post('updatestatus','ViewEmployee@UpdateStatus')->name('action');

Route::group(['middleware'=>'preventbackbutton'],function(){
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('dropdownlist/getdesignation/{id}','DependentDropdown@getdesignation');
    Route::post('/home','EmployeeLogincontroller@login')->name('Employeelogin');



});