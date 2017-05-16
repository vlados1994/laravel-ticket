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
	Route::get('/admin/modules/catalog', 'Admin\Modules\CatalogController@indexCategories')
         ->name('catalog');
    Route::get('/admin/modules/products', 'Admin\Modules\CatalogController@indexProducts')
        ->name('products');
    Route::post('/admin/modules/catalog/ajax/{action?}', 'Admin\Modules\CatalogController@ajaxCatalog')
        ->name('catalogAjax');
    Route::post('/admin/modules/products/ajax/attrs', 'Admin\Modules\CatalogController@ajaxAttrsRetrieve')
        ->name('productsAttrsRetrieve');
    Route::post('/admin/modules/products/ajax/add', 'Admin\Modules\CatalogController@ajaxProductsAdd')
        ->name('productsAdd');
    Route::post('/admin/modules/products/ajax/retrieve/products',
        'Admin\Modules\CatalogController@ajaxProductsRetrieve')
        ->name('productsRetrieve');
    Route::post('/admin/modules/products/ajax/retrieve/cats',
        'Admin\Modules\CatalogController@ajaxCategoriesRetrieve')
        ->name('categoriesRetrieve');
    Route::get('/test',
        'Admin\Modules\CatalogController@test')
        ->name('test');

});