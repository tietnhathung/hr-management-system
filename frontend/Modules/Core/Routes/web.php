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

Route::middleware('guest')->group(function() {
    Route::get('/login', 'AuthController@index')->name('login');
    Route::post('/login', 'AuthController@login')->name('auth.login');
});

Route::middleware('auth')->group(function() {
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/logout', 'AuthController@logout')->name('auth.logout');
});

Route::prefix('/personal')->middleware('auth')->group(function() {
    Route::get('/personal/edit', 'PersonalController@edit')->name('personal.edit');
    Route::post('/personal/update', 'PersonalController@update')->name('personal.update');
    Route::get('/change-password', 'PersonalController@changePasswordEdit')->name('personal.changePasswordEdit');
    Route::post('/change-password', 'PersonalController@changePasswordUpdate')->name('personal.changePasswordUpdate');
});
