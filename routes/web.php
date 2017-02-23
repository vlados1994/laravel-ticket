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

Route::get('/', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'TicketsController@create');
Route::post('/contact', 'TicketsController@store');
Route::get('/tickets', 'TicketsController@index');

Route::post('/tickets/{slug}', 'TicketsController@destroy');
Route::get('/tickets/{slug}', 'TicketsController@show');


Route::post('/ticket/{slug}/edit','TicketsController@update');
Route::get('/tickets/{slug}/edit', 'TicketsController@edit');
