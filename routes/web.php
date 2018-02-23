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
Route::get('settings', "HomeController@settings");
Route::get('infos', "HomeController@infos");

Route::get('resume', "ResumeController@index");
Route::get('resume/{resume_id}', 'ResumeController@edit');
Route::post('resume', 'ResumeController@store');

Route::delete('resume/{resume_id}', 'ResumeController@destroy');

Route::patch('resume/{resume_id}/update/status', 'ResumeController@change_resume_status');
Route::patch('resume/{resume_id}/update/date', 'ResumeController@update_resume_date');
Route::patch('resume/{resume_id}/update/privacy', 'ResumeController@change_resume_privacy');

Route::post('resume_contact/{resume_id}', 'ResumeContactController@store');

Route::get('get_counties/{city_id}', 'CityController@get_counties');
Route::get('get_cities/{country_id}', 'CountryController@get_cities');

Route::get('delete_experience/{experience_id}','ResumeExperienceController@delete');
Route::get('get_experience_details/{experience_id}', 'ResumeExperienceController@get_details');
Route::post('resume_experience/{resume_id}', 'ResumeExperienceController@store');
Route::post('edit_experience/{experience_id}', 'ResumeExperienceController@edit');

Route::post('/change_email', 'UserController@updateEmail');
Route::post('/personal_info', 'UserController@updatePersonalInfo');
Route::post('/change_password', 'UserController@changePassword');
