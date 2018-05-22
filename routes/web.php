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

Route::resource('contact', 'ContactController', [
	'except' => ['create']
]);
Route::get('api/contact', 'ContactController@apiContact')->name('api.contact');
Route::get('export', 'ContactController@contactExport')->name('contact.export');
Route::post('import', 'ContactController@contactImport')->name('contact.import');

Route::get('/absence', function () {
    return view('rawdata');
});

Route::get('/manage', function () {
    return view('manage');
});

Route::get('/summary', function () {
    return view('summary');
});

Route::resource('absence', 'AbsenController', [
	'except' => ['create']
]);

Route::get('api/absence', 'AbsenController@apiAbsence')->name('api.absence');
Route::get('export', 'AbsenController@absenceExport')->name('absence.export');
Route::post('import', 'AbsenController@absenceImport')->name('absence.import');
