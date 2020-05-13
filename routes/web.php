<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');

//oute::get('/admin', 'DashboardController@index');

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/contas', 'UserController@contas');
Route::get('/conta/{conta}/dados','UserController@dados')->name('conta.dados');

Auth::routes();
