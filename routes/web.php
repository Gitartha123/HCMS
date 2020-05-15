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


Route::get('/action','ViewEmployee@Action')->name('action');
Route::get('users', ['uses'=>'ViewEmployee@index', 'as'=>'users.index']);
Route::post('/submission','EmployeeRecordSubmit@FinalSubmit')->name('submission');
Route::get('/registered','EmployeeRecordSubmit@FinalSubmit')->name('employeeregistration');
Route::post('/registered','EmployeeRegistration@saveData')->name('employeeregistration');
Route::post('updatestatus','ViewEmployee@UpdateStatus')->name('action');
Route::post('request','RequestController@sendRequest')->name('request');
Route::get('/myprofile','EmployeePanel@myProfile')->name('myprofile');
Route::get('/viewrequest2',['uses'=>'RequestController@viewRequest','as'=>'request.viewRequest']);
Route::get('/ignore','RequestController@Ignore')->name('ignore');
Route::get('/accept','RequestController@Accept')->name('accept');
Route::get('/index','EmployeePanel@index')->name('body');
Route::get('/response','RequestController@Response')->name('response');
Route::post('/sendcontact','RequestController@sendContact')->name('sendcontact');
Route::get('/viewedit','Requestcontroller@viewEdit')->name('viewedit');
Route::get('/applyleave','LeaveController@applyLeave')->name('apply');
Route::post('leave','LeaveController@submitRequest')->name('applyLeave');
Route::get('/requested','LeaveController@status')->name('leave');
Route::get('/editleave','LeaveController@editLeave')->name('editleave');
Route::post('/update','LeaveController@UpdateLeave')->name('editapplyLeave');
Route::get('/deleteleave','LeaveController@deleteLeave')->name('deleteleave');
Route::get('/employeeleaverequest','LeaveController@showLeave');
Route::get('/acceptleave','LeaveController@acceptLeave')->name('acceptleave');
Route::get('/rejectleave','LeaveController@rejectLeave')->name('rejectleave');
Route::get('/viewnotice','LeaveController@afterLeaveNoticeView')->name('afterleavenoticeview');

Route::get('/status',function (){
    return view('employee.leavestatus');
})->name('status');
Route::group(['middleware'=>'preventbackbutton'],function(){
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('dropdownlist/getdesignation/{id}','DependentDropdown@getdesignation');
    Route::post('/home','EmployeeLogincontroller@login')->name('Employeelogin');
});

Route::group(['middleware' => 'auth'],function(){
   Auth::routes();
   Route::get('/home',function (){
      return view('home');
   })->name('home');

   Route::get('/employee',function (){
      return view('employeeHome');
   })->name('employee');
});