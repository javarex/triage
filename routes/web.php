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
    if (!(is_null(auth()->user()))) {
        if (auth()->user()->role == 0) {
            return redirect('/admin');
        } elseif (auth()->user()->role == 1) {
            return redirect('/establishment');
        } else {
            return redirect('/triage');
        }
    }
    return view('auth.login');
});


Route::get('/logout', 'LogoutController@logout_user');

Auth::routes(['verify' => true], function () {
    if (is_null(Auth::user()->email)) {
        return redirect('/triage');
    }
});


Route::get('/home', 'HomeController@index')->name('home');

//hash user route
Route::get('/userHash', 'AdminController@userHash');

//Triage Routes

Route::resource('triage', 'TriageController')->middleware('client');
Route::middleware(['client'])->group(function () {
    Route::get('exportId', 'TriageController@exportId');
    Route::post('qredit', 'TriageController@qrEdit');
    Route::post('updateSecurity', 'TriageController@updateSecurity');
    Route::post('profile_edit', 'TriageController@profile_edit');
    Route::get('/history', 'TriageController@view_history');
});

Route::post('/tag', 'TagController@store');
Route::post('/untag', 'TagController@untagUser');

//admin routes and controllers

Route::resource('/admin', 'AdminController')->middleware('admin');
Route::get('export', 'AdminController@export')->name('export');
Route::post('/import', 'AdminController@import');
Route::get('create/establishment', 'AdminController@create');
Route::middleware(['admin'])->group(function () {
    Route::get('userModule', 'AdminController@userModule_index');
    Route::get('adminEstab', 'AdminController@establishment_index');
    Route::get('ccts_reports', 'AdminController@report');
    Route::post('/admin/print-pdf',['as' => 'citizen.printpdf', 'uses' => 'AdminController@printPDF']);
    Route::post('/admin/client', 'AdminController@updateClient');
    Route::post('/user/getUser/', 'AdminController@getUser')->name('user.getUser');
    Route::get('/adminUsers/searchUser/', 'AdminController@searchUser')->name('adminUsers.searchUser');
    Route::get('/deleteUser', 'AdminController@deleteUser');
    Route::get('/updateQRUser', 'AdminController@updateQRuser');
    Route::get('/viewqr/{user_id}', 'AdminController@view_qrcode');

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
    Route::get('/establishment/getData', 'EstablishmentController@getData');
});




// Client routes/controllers

// Route::resource('client', 'ClientController');
Route::get('/userDdo/create', 'ClientController@create');
Route::post('/validateInputs', 'ClientController@validateInputs');
Route::get('/load/municipal/{id}', 'ClientController@loadMunicipals');
Route::get('/load/barangay/{bid}', 'ClientController@loadBarangays');
Route::get('/load/province', 'ClientController@loadProvince');


// Scanner routes

Route::post('/transmit', 'ApiController@transmit');
Route::get('/download', 'ApiController@download');
Route::post('/api/login', 'ApiController@login');
Route::get('/total_records', 'ApiController@total_records');

// edit qr code
Route::post('/qrEdit', 'TriageController@qrEdit');

//terminal scanning
Route::get('/terminal_scan', 'ApiController@terminal_scan')->name('terminal_scan');
Route::post('/terminal_scan_login', 'ApiController@terminal_scan_login')->name('terminal_scan_login');


// logs route
Route::get('/logs', 'LogController@index')->middleware('admin');
Route::post('/logs/get_user', 'LogController@get_user');