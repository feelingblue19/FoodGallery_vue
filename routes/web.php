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

Route::get('verifikasi/{email_token}', ['as' => 'User.verif', 'uses'=>'UserController@verifikasi']);

Route::get('{any}', function () {
    return view('layout');
})->where('any','.*');




