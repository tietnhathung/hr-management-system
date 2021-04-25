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

Route::group(['middleware' => ['auth', 'permission:menu_manager']], function () {
    Route::resource('menu', 'MenuController');
//    Route::post('menu/destroy', 'MenuController@destroy')->name('menu.destroy');
    Route::post('menu/destroyMany', 'MenuController@destroyMany')->name('menu.destroyMany');
    Route::post('menu/updateStatus', 'MenuController@updateStatus')->name('menu.updateStatus');
    Route::post('menu/updateOrder', 'MenuController@updateOrder')->name('menu.updateOrder');
});
