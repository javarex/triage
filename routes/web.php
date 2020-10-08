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

Route::get('/logout', function()
{
    Auth::logout();
    return redirect('/admin/login');
});
Auth::routes();


Route::get('/admin/login', function(){
    return view('admin.loginForm');
});
Route::resource('/admin', 'AdminController')->middleware('admin');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/client/create','ClientController@create')->name('client.create');
Route::post('/client','ClientController@store')->name('client.store');

Route::resource('office','OfficeController');
Route::post('/office/clientLog', 'OfficeController@clientLog');

Route::resource('officeLog', 'officeLogController')->middleware('office');;
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

