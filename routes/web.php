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

// https://laravellast.dev/hotels/?name=Concorde%20Hotel&price=60-200&date=22-10-2020%2C22-11-2020&city=Manila&sortBy=name or price 
Route::get('/hotels','HotelsController@index' );
