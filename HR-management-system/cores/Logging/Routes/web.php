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

Route::prefix('logging')->middleware(['auth', 'permission:logging_manager'])->group(function() {
    Route::get('', 'LoggingController@index');
    Route::get('/activity', 'LoggingController@loggingactivity');
//        ->middleware(\Core\Logging\Http\Middleware\LogActivityRequests::class);
});
