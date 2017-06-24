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
Route::get('add_notice', 'AdminController@add_notice')->name('add_notice');
Route::get('update_notice', 'AdminController@update_notice')->name('update_notice');
Route::get('view_notice', 'AdminController@view_notice')->name('view_notice');
Route::get('view_my_notice', 'AdminController@view_my_notice')->name('view_my_notice');
Route::post('create_notice', 'AdminController@create_notice')->name('create_notice');
Route::get('edit_notice/{id}', 'AdminController@edit_notice')->name('edit_notice');
Route::get('delete_notice/{id}', 'AdminController@delete_notice')->name('delete_notice');
Route::get('add_role', 'AdminController@add_role')->name('add_role');
Route::post('create_role', 'AdminController@create_role')->name('create_role');
Route::get('memberaccount',function(){
  return view ('Admin.user_account');
})->name('memberaccount');
Route::get('adminaccount',function(){
  return view ('Admin.admin_account');
})->name('adminaccount');
Route::get('/', 'AdminController@index')->name('publish');
Route::get('login', 'UserController@login')->name('login');
Route::get('Myaccount', 'UserController@myaccount')->name('Myaccount');
Route::post('member_validate', 'UserController@member_validate')->name('member_validate');
Route::get('register_form', 'UserController@create')->name('register_form');
Route::post('register', 'UserController@store')->name('register');
Route::get('/show', 'UserController@show');
Route::get('/add_role', 'AdminController@add_role')->name('add_role');





