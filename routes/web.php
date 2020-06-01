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

Auth::routes(['verify' =>true]);

Route::middleware(['auth', 'verified', 'bloqueado'])->group(function () {
    Route::get('/home','HomeController@authenticatedIndex')->name('dashboard')->middleware('can:viewAny,App\User');
    Route::get('/user/password/edit','UserController@passwordEdit')->name('user.pass.edit')->middleware('can:update,App\User');
    Route::get('/conta/movimento/{movimento}/edit', 'MovementController@edit')->name('movement.edit')->middleware('can:update,movimento');
    Route::get('conta/movimento/{movimento}/imagem','MovementController@getFoto')->name('movement.image')->middleware('can:view,movimento');
    Route::get('/conta/{conta}/movimento/create', 'MovementController@create')->name('movement.create')->middleware('can:create,App\Movimento');
    Route::get('/contas/removed', 'ContaController@listDeleted')->name('contas.removed')->middleware('can:viewAny,App\Conta');
    Route::get('/contas/{id}/restore', 'ContaController@restore')->name('conta.restore')->middleware('can:restore,App\Conta,id');
    Route::get('/conta', 'ContaController@create_conta')->name('conta.create')->middleware('can:create,App\User');
    Route::get('/user/dados', 'UserController@edit')->name('user.edit')->middleware('can:update,App\User');
    Route::get('/admin', 'AdminController@index')->name('admin.index')->middleware('can:viewAny,App\User');
    Route::get('/contas', 'ContaController@index')->name('contas')->middleware('can:viewAny, App\Conta');
    Route::get('/conta/{conta}','MovementController@index')->name('conta.dados')->middleware('can:view,conta');
    Route::put('/conta/{conta}', 'ContaController@update')->name('conta.update')->middleware('can:update,conta');
    Route::delete('/conta/{conta}', 'ContaController@close')->name('conta.delete')->middleware('can:delete,conta');
    Route::post('/conta/create/store', 'ContaController@store')->name('conta.store')->middleware('can:create,App\Conta');
    Route::delete('/contas/{id}/permadel', 'ContaController@permanentDelete')->name('conta.permadel')->middleware('can:forceDelete,App\Conta,id');
    Route::post('/conta/{conta}/atribuir', 'ContaController@atribuir')->name('conta.atribuir')->middleware('can:update,conta');
    Route::delete('/conta/{conta}/revogar', 'ContaController@revogar')->name('conta.revogar')->middleware('can:update,conta');
    Route::post('/conta/{conta}/movimento/store', 'MovementController@store')->name('movement.store')->middleware('can:create,App\Movimento');
    Route::put('/conta/movimento/{movimento}/update', 'MovementController@update')->name('movement.update')->middleware('can:update,movimento');
    Route::delete('/conta/movimento/{movimento}/delete', 'MovementController@destroy')->name('movement.delete')->middleware('can:delete,movimento');
    Route::put('/admin/{user}/blq', 'AdminController@block')->name('admin.blq')->middleware('can:update_Blq_tipo,user');
    Route::put('/admin/{user}/unblq', 'AdminController@unblock')->name('admin.unblq')->middleware('can:update_Blq_tipo,user');
    Route::put('/admin/{user}/promote', 'AdminController@promote')->name('admin.promote')->middleware('can:update_Blq_tipo,user');
    Route::put('/admin/{user}/demote', 'AdminController@demote')->name('admin.demote')->middleware('can:update_Blq_tipo,user');
    Route::put('/user/update', 'UserController@update')->name('user.update')->middleware('can:update,App\User');
    Route::put('/user/foto/remove', 'UserController@fotoRemove')->name('user.foto.remove')->middleware('can:update,App\User');
    Route::patch('/user/password/update','UserController@passwordUpdate')->name('user.pass.update')->middleware('can:update,App\User');
    Route::delete('/user/delete','UserController@delete')->name('user.delete')->middleware('can:delete,App\User');
});
