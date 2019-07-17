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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/loop','LoopController@index');
Route::post('/loop/proses','LoopController@proses');
Route::get('/ongkir','OngkirController@index');
Route::post('/ongkir/proses','OngkirController@proses');
Route::get('/ongkir/getKota/{id}','OngkirController@getKota');
Route::post('/ongkir/getOngkir','OngkirController@getOngkir');