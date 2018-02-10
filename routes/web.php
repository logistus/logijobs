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

Route::get('/resumes', "ResumeController@index");
Route::get('/edit_resume/{id}', 'ResumeController@edit');
Route::post('save_resume', 'ResumeController@store');
Route::get('change_resume_status/{resume_id}', 'ResumeController@change_resume_status');
Route::get('update_resume_date/{resume_id}', 'ResumeController@update_resume_date');
Route::get('delete_resume/{resume_id}', 'ResumeController@destroy');

Route::post('/account_settings', 'UserController@update');
Route::post('/change_password', 'UserController@changePassword');
