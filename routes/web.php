<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Auth::routes();

Route::get('/dashboard', function () {
    return view('dashboard');
});



Route::domain('{user_name}.'.config('app.url'))->group(function () {
    Route::get('/', 'Front\HomeController@user_locations')->name('user_locations');
});




 //==============================Translate all pages============================
Route::group(
    [
        'middleware' => ['auth']
    ], function () {

     //==============================dashboard============================
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');


    //============================== Admins ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('admins', 'AdminController');
    });
    //============================== Users ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('users', 'UserController');
    });

    //============================== providers ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('providers', 'ProviderController');
    });

    //============================== locations ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('locations', 'LocationController');
    });


});

