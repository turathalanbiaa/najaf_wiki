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


Route::get('/', 'Website\HomeController@home');
Route::get('/index', 'Website\HomeController@index');
Route::get('/search', 'Website\HomeController@search');
Route::get('/post/{id}', 'Website\HomeController@show')->name('post');

Route::resource('dashboard','Dashboard\DashboardController');
Route::get('/get_subcategory/{id}', 'Dashboard\DashboardController@getSubcategory');

Auth::routes(['register' => false]);

Route::resource('admin','Admin\AdminController');
Route::get('edit-password/{id}','Admin\AdminController@edit_password')->name('edit-password');
Route::post('update-password/{id}','Admin\AdminController@update_password')->name('update-password');
