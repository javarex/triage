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
   
    if(!(is_null(Auth::user()))){
        if (Auth::user()->type == 'admin') {
            return redirect('/admin');
        }elseif (Auth::user()->type == 'office') {
            return redirect('/officeLog');
        }else{
            return redirect('/triage');
        }
    }
    return view('auth.login');
});


Route::get('/logout', 'LogoutController@logout_user');

Auth::routes(['verify' => true], function (){
    if (is_null(Auth::user()->email)) {
        return redirect('/triage');
    }
});


Route::get('/admin/login', function(){
    return view('admin.loginForm');
});
Route::resource('/admin', 'AdminController')->middleware('admin');
Route::get('/home', 'HomeController@index')->name('home');


Route::resource('client','ClientController');

Route::resource('office','OfficeController');
Route::post('/office/clientLog', 'OfficeController@clientLog');

Route::resource('officeLog', 'officeLogController')->middleware('office');
Route::post('/officeLog1','officeLogController@storeTriage');

//Triage Routes

Route::resource('triage', 'TriageController')->middleware('client');

Route::post('/officeLog/approveStatus/{id}', 'ActivityController@updateStatus');
Route::get('/approveStatus/{id}', 'ActivityController@loadRecord');
Route::post('/officeLog/setTimeOut', 'ActivityController@setTimeOut');
Route::post('/officeLog/setTimeIn', 'ActivityController@setTimeIn');

Route::get('/loadActivity/{id}', 'ActivityController@loadData');    

Route::post('/admin/client', 'AdminController@updateClient');

Route::post('/tag', 'TagController@store');
Route::post('/untag', 'TagController@untagUser');

Route::get('export', 'AdminController@export')->name('export');
Route::post('/import', 'AdminController@import');
Route::resource('registration', 'RegistrationController');

//check duplication

Route::post('/checkDuplication', 'RegistrationController@checkName');

//validate name for registration
Route::post('/validateInputs', 'RegistrationController@validateNames');

