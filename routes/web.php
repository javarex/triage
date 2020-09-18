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
    return view('Auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/client/create','ClientController@create')->name('client.create');
Route::post('/client','ClientController@store')->name('client.store');

Route::resource('/office','OfficeController');

//Triage Routes

Route::resource('triage', 'TriageController');
// Route::get('/triage/load_history','TriageController@load_history');
// Route::post('/triage/load_history', 'TriageController@load_history');
