<?php

use Illuminate\Support\Facades\Auth;
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


Route::get('/', 'SiteController@index');


Route::get('/twitch', 'TwitchLoginController@loginTwitch');
Route::get('/twitch/callback', 'TwitchLoginController@loginTwitchCallback');
Route::get('/twitch/info/{canal}', 'TwitchController@getInformacoesCanal');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('login', function(){
    return redirect('/');
})->name('login');

// Route::get('/home', 'HomeController@index')->name('home');


Route::get('/receber-premio', 'RetirarPremioController@index')->name('home')->middleware('auth');
Route::post('/premio-status', 'RetirarPremioController@verificaPremioRetirada')->middleware('auth');
Route::get('/cadastrar-codigo', 'RetirarPremioController@cadastrarCodigo')->name('cadastrar.codigos')->middleware('auth');
Route::post('/cadastrar-codigo', 'RetirarPremioController@storeCadastrarCodigo')->name('store.codigos')->middleware('auth');
Route::get('/cadastrar-codigo-csv', 'RetirarPremioController@viewCSVCadastrarCodigo')->name('cadastrar.codigos.csv')->middleware('auth');
Route::post('/cadastrar-codigo-csv', 'RetirarPremioController@storeCSVCadastrarCodigo')->name('store.codigos.csv')->middleware('auth');
Route::get('/dashboard', 'RetirarPremioController@dashboardPremios')->name('admin.dashboard.premios')->middleware('auth');

Route::post('/vincular-premio', 'RetirarPremioController@vicularPremioUser')->name('store.vincular')->middleware('auth');
Route::post('/confirmar-email', 'RetirarPremioController@verificarEmail')->middleware('auth');

// Route::get('/parametrizacao')
Route::get('mod', 'PermissionsController@moderatorConfirm');

// Start Routes EasyPermissions
Route::get('/erro', 'PermissionsController@erroAcess');

Route::get('/groups', 'PermissionsController@showGroups')->name('permissions.group.list')->middleware('auth');
Route::get('/groups/create', 'PermissionsController@createGroup')->name('permissions.group.create')->middleware('auth');
Route::post('/groups/create', 'PermissionsController@storeGroup')->name('permissions.group.create.store')->middleware('auth');
Route::get('/groups/edit/{id}', 'PermissionsController@editGroup')->middleware('auth');
Route::post('/groups/edit/{id}', 'PermissionsController@updateGroup')->middleware('auth');
Route::get('/groups/m/{id}', 'PermissionsController@showMembersGroup')->name('permissions.group.members.edit')->middleware('auth');
Route::post('/groups/m/{id}', 'PermissionsController@storeMemebersGroup')->name('permissions.group.members.store')->middleware('auth');

Route::get('/rules', 'PermissionsController@showRules')->name('permissions.rules.list')->middleware('auth');
Route::get('/rules/create', 'PermissionsController@createRules')->name('permissions.rules.create')->middleware('auth');
Route::post('/rules/create', 'PermissionsController@storeRules')->middleware('auth');
Route::get('/rules/m/{id}', 'PermissionsController@preShowMembersRules')->name('permissions.rules.permissions.edit')->middleware('auth');
Route::post('/rules/m/{id}', 'PermissionsController@showMembersRules')->middleware('auth');
Route::post('/rules/m/{id}/s', 'PermissionsController@storeMemeberRules')->name('permissions.rules.permissions.store')->middleware('auth');
//End Routes EasyPermissions
