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


Auth::routes();
Route::get("/register/confirm/{verify_token}", "AuthController@confirmEmail");

Route::get('/', 'HomeController@index');
Route::get('/settings', "HomeController@settings");
Route::get('/resumes', "HomeController@resumes");

Route::post('/account_settings', 'UserController@update');
Route::post('/change_password', 'UserController@changePassword');
