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

Route::get('/', 'menuController@index');
Route::get('/generar', 'menuController@generar');
Route::get('/comprobante', 'menuController@generar');
Route::resource('prestamo', 'prestamoController');
Route::resource('cliente', 'clientesController');
Route::group(['prefix'=>'usuario','as'=>'usuario.'], function() {
    Route::get('/create', 'usuarioController@create')->name('create');
    Route::post('/store/', 'usuarioController@store')->name('store');
    Route::get('/login', 'usuarioController@login')->name('login');
    Route::post('/validation', 'usuarioController@validation')->name('validation');
    });

