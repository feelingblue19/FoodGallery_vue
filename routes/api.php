<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('user', 'UserController@index')->middleware('corsbarry');
Route::post('user/create', 'UserController@store')->middleware('corsbarry');
Route::get('user/{id}', 'UserController@show')->middleware('corsbarry');
Route::put('user/update/{id}', 'UserController@update')->middleware('corsbarry');
Route::delete('user/delete/{id}', 'UserController@destroy')->middleware('corsbarry');
Route::post('user/login', 'UserController@login')->middleware('corsbarry');

Route::get('review', 'ReviewController@index')->middleware('corsbarry');
Route::post('review/create', 'ReviewController@store')->middleware('corsbarry');
Route::get('review/{id}', 'ReviewController@show')->middleware('corsbarry');
Route::post('review/update/{id}', 'ReviewController@update')->middleware('corsbarry');
Route::delete('review/delete/{id}', 'ReviewController@destroy')->middleware('corsbarry');

Route::get('recipe', 'RecipeController@index')->middleware('corsbarry');
Route::post('recipe/create', 'RecipeController@store')->middleware('corsbarry');
Route::get('recipe/{id}', 'RecipeController@show')->middleware('corsbarry');
Route::post('recipe/update/{id}', 'RecipeController@update')->middleware('corsbarry');
Route::delete('recipe/delete/{id}', 'RecipeController@destroy')->middleware('corsbarry');

Route::get('cafe', 'CafeController@index')->middleware('corsbarry');
Route::post('cafe/create', 'CafeController@store')->middleware('corsbarry');
Route::get('cafe/{id}', 'CafeController@show')->middleware('corsbarry');
Route::post('cafe/update/{id}', 'CafeController@update')->middleware('corsbarry');
Route::delete('cafe/delete/{id}', 'CafeController@destroy')->middleware('corsbarry');
