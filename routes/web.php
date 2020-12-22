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
   
    if(!(is_null(auth()->user()))){
        if (auth()->user()->role == 0) {
            return redirect('/admin');
        }elseif (auth()->user()->role == 1) {
            return redirect('/establishment');
        }else{
            return redirect('/triage');
        }   
    }
    return view('admin.loginForm');
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
Route::middleware(['admin'])->group(function () {
    Route::get('userModule','AdminController@userModule_index');
    Route::get('adminEstab','AdminController@establishment_index');
    Route::get('ccts_reports','AdminController@report');
    Route::post('generateReport','AdminController@generateReport');
    Route::post('/user/getUser/','AdminController@getUser')->name('user.getUser');
});

// Establishment routes
Route::get('/establishment/create', 'EstablishmentController@create');
// Route::get('/establishment', 'EstablishmentController@index');
Route::post('establishment', 'EstablishmentController@store');
Route::post('establishmentValidate', 'EstablishmentController@establishmentValidate');
Route::middleware(['establishment'])->group(function () {
    Route::post('addTerminal', 'EstablishmentController@terminalStore');
    Route::patch('updateEstablishment/{user_id}', 'EstablishmentController@updateEstablishment');
    Route::get('/establishment', 'EstablishmentController@index');
    Route::post('/editTerminal/{terminalId}', 'EstablishmentController@editTerminal');
    Route::post('/deleteTerminal/{terminalId}', 'EstablishmentController@deleteTerminal');
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
Route::get('/api/login', 'ApiController@login');
Route::get('/total_records', 'ApiController@total_records');

// edit qr code 
Route::post('/qrEdit','TriageController@qrEdit');

