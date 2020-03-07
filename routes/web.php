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
/*Dashboard */
Auth::routes();
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::post('/login/admin', 'Auth\LoginController@adminLogin');


Route::resource('dashboard/admins','Dashboard\AdminController');
Route::get('dashboard/admin/editPassword/{id}','Dashboard\AdminController@editPassword')->name('editPassword');
Route::post('dashboard/admin/updatePassword/{id}','Dashboard\AdminController@updatePassword')->name('updatePassword');

Route::get('dashboard/admin/showChangePasswordForm','Auth\ChangePasswordController@showChangePasswordForm')->name('showChangePasswordForm');
Route::post('dashboard/admin/changePassword','Auth\ChangePasswordController@changePassword')->name('changePassword');

Route::resource('dashboard/posts','Dashboard\PostController');
Route::get('dashboard/getSubcategory/{id}', 'Dashboard\PostController@getSubcategory');


/* Website*/
Route::get('/', 'Website\PostController@home');
Route::get('post', 'Website\PostController@post');

Route::get('search', 'Website\PostController@search');
Route::get('post/{id}', 'Website\PostController@show')->name('post');
Route::get('comments/{id}', 'Website\CommentController@show')->name('comments');
Route::post('comment/{id}', 'Website\CommentController@store')->name('comment');

