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

Route::get('/', 'HomeController@winner');

Route::get('/home', 'AdminController@index');

Route::post('/draw', 'AdminController@draw');

Route::get('/member', 'MemberController@index');

Route::post('/purchase_number', 'MemberController@purchase_number');
