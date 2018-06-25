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
    return view('summary');
});



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

Route::resource('summary', 'SummaryController', [
	'except' => ['create']
]);

Route::get('api/summary', 'SummaryController@apiSummary')->name('api.summary');
Route::get('exports', 'SummaryController@summaryExport')->name('summary.export');
Route::post('imports', 'SummaryController@summaryImport')->name('summary.import');

Route::get('api/absence', 'AbsenController@apiAbsence')->name('api.absence');
Route::get('export', 'AbsenController@absenceExport')->name('absence.export');
Route::post('import', 'AbsenController@absenceImport')->name('absence.import');

Route::get('/test', 'AbsenController@apiAbsenceDate')->name('api.absenceDate');
Route::post('/test', 'Controller@getData')->name('test.store');

//Route::get('/test2', 'AbsenController@test');
Route::post('/test2', 'AbsenController@getData')->name('test.store');