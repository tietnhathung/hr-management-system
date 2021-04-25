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
Route::group(['middleware' => ['auth']], function () {

    Route::resource('user', 'UserController');
    Route::post('user/destroyMany', 'UserController@destroyMany')->name('user.destroyMany');
    Route::post('user/updateStatus', 'UserController@updateStatus')->name('user.updateStatus');
    Route::post('user/logout/{Id}', 'UserController@logout')->name('user.logout');

});

Route::group(['middleware' => ['auth']], function () {
    Route::get('user/profile/changeProfile', 'UserProfileController@changeProfile')->name('user.changeProfile');
    Route::put('user/profile/updateProfile', 'UserProfileController@updateProfile')->name('user.updateProfile');
    Route::get('profile', 'UserProfileController@profile')->name('user.profile');
    Route::get('changePassword', 'UserProfileController@changePassword')->name('user.changePassword');
    Route::put('updatePassword', 'UserProfileController@updatePassword')->name('user.updatePassword');
});
