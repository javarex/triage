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
    return view('auth.login');
});

Route::get('/logout', function()
{
    Auth::logout();
    return redirect('/admin/login');
});
Auth::routes();

Route::get('/admin/login','AdminController@loginForm')->name('admin.login');
Route::resource('/admin', 'AdminController');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/client/create','ClientController@create')->name('client.create');
Route::post('/client','ClientController@store')->name('client.store');

Route::resource('office','OfficeController');
Route::post('/office/clientLog', 'OfficeController@clientLog');

Route::resource('officeLog', 'officeLogController');
Route::post('/officeLog1','officeLogController@storeTriage');

//Triage Routes

Route::resource('triage', 'TriageController');

Route::post('/officeLog/approveStatus/{id}', 'ActivityController@updateStatus');
Route::get('/approveStatus/{id}', 'ActivityController@loadRecord');

Route::get('/loadActivity/{id}', 'ActivityController@loadData');    

Route::post('/admin/client', 'AdminController@updateClient');

Route::post('/tag', 'TagController@store');

