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

use Illuminate\Support\Facades\Route;

Route::prefix('timekeeping')->group(function() {
    Route::get('/', 'TimekeepingController@index')->name("timekeeping.index");
    Route::get('/download', 'TimekeepingController@download')->name("timekeeping.download");
});
