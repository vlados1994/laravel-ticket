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
Route::get('/', 'PagesController@main');

//about 
Route::get('/about', 'PagesController@about');

//auth
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

//admin part
Route::group(['middleware' => 'admin'], function () {

	Route::get('/admin', 'Admin\BackendController@index')->name('admin');
	Route::get('/admin/routing', 'Admin\Pages\RoutingController@index')->name('routing');

	//catalog routes
	Route::get('/admin/modules/catalog', 'Admin\Modules\CatalogController@showCategories')
         ->name('catalog');
    Route::get('/admin/modules/products', 'Admin\Modules\CatalogController@showProducts')
        ->name('products');
    Route::post('/admin/modules/catalog/ajax/{action?}', 'Admin\Modules\CatalogController@ajaxCatalog')
        ->name('catalogAjax');
    Route::post('/admin/modules/products/ajax/{action?}', 'Admin\Modules\CatalogController@ajaxProducts')
        ->name('productsAjax');
    Route::get('/admin/modules/products/ajax/{action?}', 'Admin\Modules\CatalogController@ajaxProducts')
        ->name('productsAjax');
});