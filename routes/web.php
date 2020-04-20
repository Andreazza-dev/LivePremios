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


Route::get('/', 'SiteController@index');

// Auth::routes();


Route::get('/twitch', 'TwitchLoginController@loginTwitch');
Route::get('/twitch/callback', 'TwitchLoginController@loginTwitchCallback');
Route::get('/twitch/info/{canal}', 'TwitchController@getInformacoesCanal');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Route::get('/home', 'HomeController@index')->name('home');


Route::get('/receber-premio', 'RetirarPremioController@index')->name('home')->middleware('auth');
Route::post('/premio-status', 'RetirarPremioController@verificaPremioRetirada')->middleware('auth');
Route::get('/cadastrar-codigo', 'RetirarPremioController@cadastrarCodigo')->name('cadastrar.codigos')->middleware('auth');
Route::post('/cadastrar-codigo', 'RetirarPremioController@storeCadastrarCodigo')->name('store.codigos')->middleware('auth');
Route::get('/dashboard', 'RetirarPremioController@dashboardPremios')->name('admin.dashboard.premios')->middleware('auth');

Route::post('/vincular-premio', 'RetirarPremioController@vicularPremioUser')->name('store.vincular')->middleware('auth');
Route::post('/confirmar-email', 'RetirarPremioController@verificarEmail')->middleware('auth');
