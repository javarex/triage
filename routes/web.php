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
        if (Auth::user()->role == 0) {
            return redirect('/admin');
        }elseif (Auth::user()->role == 1) {
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

Route::get('/home', 'HomeController@index')->name('home');


//Triage Routes

Route::resource('triage', 'TriageController')->middleware('client');


Route::post('/tag', 'TagController@store');
Route::post('/untag', 'TagController@untagUser');

//admin routes and controllers

Route::post('/admin/client', 'AdminController@updateClient');
Route::resource('/admin', 'AdminController')->middleware('admin');
Route::get('export', 'AdminController@export')->name('export');
Route::post('/import', 'AdminController@import');
Route::get('create/establishment', 'AdminController@create');

// Establishment routes
Route::get('/establishment/create', 'EstablishmentController@create');
Route::post('establishment', 'EstablishmentController@store');
Route::middleware(['admin'])->group(function () {
    Route::get('admin/establishment', 'AdminController@show')->name('establish');
});



// Client routes/controllers

Route::resource('client','ClientController');
Route::post('/validateInputs', 'ClientController@validateInputs');
Route::get('/load/municipal/{id}','ClientController@loadMunicipals');
Route::get('/load/barangay/{bid}','ClientController@loadBarangays');
Route::get('/load/province','ClientController@loadProvince');


// Scanner routes

Route::post('/transmit', 'ApiController@transmit');
Route::get('/download', 'ApiController@download');

// edit qr code 
Route::post('/qrEdit','TriageController@qrEdit');

