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

Route::group(['middleware' => ['auth', 'permission:role_manager']], function () {
    Route::resource('role', 'RoleController');
    Route::post('role/destroyMany', 'RoleController@destroyMany')->name('role.destroyMany');
    Route::post('role/updateStatus', 'RoleController@updateStatus')->name('role.updateStatus');
});
