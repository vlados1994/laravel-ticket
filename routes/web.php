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

//pages
Route::get('/', 'PagesController@home');

//about 
Route::get('/about', 'PagesController@about');

//contact
Route::get('/contact', 'TicketsController@create');
Route::post('/contact', 'TicketsController@store');

//tickets
Route::get('/tickets', 'TicketsController@index');
Route::post('/tickets/{slug}/delete', 'TicketsController@destroy');
Route::get('/tickets/{slug}', 'TicketsController@show');
Route::post('/tickets/{slug}/edit','TicketsController@update');
Route::get('/tickets/{slug}/edit', 'TicketsController@edit');

//comment
Route::post('/comment', 'CommentsController@newComment');

//auth
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
//admin part
Route::group(['middleware' => 'admin'], function () {

	Route::get('/admin', 'Admin\BackendController@index')->name('admin');
	Route::get('/admin/routing', 'Admin\Pages\routingController@index')->name('routing');

});