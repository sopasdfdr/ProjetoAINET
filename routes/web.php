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

Route::get('/', 'HomeController@index')->name('home');

//Route::get('/admin', 'DashboardController@index');

Auth::routes(['verify' =>true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', 'AdminController@index')->name('admin.index');
    Route::get('/contas', 'ContaController@index')->name('contas');
    Route::get('/conta/{conta}','MovementController@index')->name('conta.dados');
    Route::put('/conta/{conta}', 'ContaController@update')->name('conta.update');
    Route::delete('/conta/{conta}', 'ContaController@destroy')->name('conta.delete');
    Route::get('/conta', 'ContaController@create_conta')->name('conta.create');
    Route::post('/conta/create/store', 'ContaController@store')->name('conta.store');
    Route::get('/conta/{conta}/movimento/create', 'MovementController@create')->name('movement.create');
    Route::post('/conta/{conta}/movimento/store', 'MovementController@store')->name('movement.store');
    Route::get('/conta/movimento/{movimento}/edit', 'MovementController@edit')->name('movement.edit');
    Route::put('/conta/movimento/{movimento}/update', 'MovementController@update')->name('movement.update');
    Route::delete('/conta/movimento/{movimento}/delete', 'MovementController@destroy')->name('movement.delete');
    Route::put('/admin/{user}/blq', 'AdminController@block')->name('admin.blq');
    Route::put('/admin/{user}/unblq', 'AdminController@unblock')->name('admin.unblq');
    Route::put('/admin/{user}/promote', 'AdminController@promote')->name('admin.promote');
    Route::put('/admin/{user}/demote', 'AdminController@demote')->name('admin.demote');
    Route::post('/conta/{conta}/atribuir', 'ContaController@atribuir')->name('conta.atribuir');
});
