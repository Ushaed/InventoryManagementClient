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


use Illuminate\Support\Facades\Route;



Route::get('/', 'AuthController@index')->name('login')->middleware('guest');
Route::post('/', 'AuthController@login')->name('login.submit')->middleware('guest');
Route::group(['middleware' => 'checkClient'],function(){

    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::get('/dashboard', 'AuthController@dashboard')->name('dashboard');
    Route::get('/profile', 'AuthController@profile')->name('profile');
    Route::get('/setting', 'AuthController@setting')->name('setting');
    Route::put('/setting', 'AuthController@updateSetting')->name('setting.store');

    Route::prefix('users')->group(function (){
        Route::get('/', 'UserController@index')->name('users.index');
        Route::post('/', 'UserController@store')->name('users.store')->middleware('manager');
        Route::get('create', 'UserController@create')->name('users.create')->middleware('manager');
        Route::get('{id}', 'UserController@show')->name('users.show');
        Route::put('{id}', 'UserController@update')->name('users.update')->middleware('manager');
        Route::delete('{id}', 'UserController@delete')->name('users.delete')->middleware('manager');
        Route::get('{id}/edit', 'UserController@edit')->name('users.edit')->middleware('manager');
    });
    Route::group(['prefix' => 'brands'],function (){
        Route::get('/', 'BrandController@index')->name('brands.index');
        Route::post('/', 'BrandController@store')->name('brands.store')->middleware('manager');
        Route::get('/create', 'BrandController@create')->name('brands.create')->middleware('manager');
        Route::get('/{id}', 'BrandController@show')->name('brands.show');
        Route::put('/{id}', 'BrandController@update')->name('brands.update')->middleware('manager');
        Route::delete('/{id}', 'BrandController@delete')->name('brands.delete')->middleware('manager');
        Route::get('/{id}/edit/', 'BrandController@edit')->name('brands.edit')->middleware('manager');
    });
    Route::group(['prefix' => 'categories'],function (){
        Route::get('/', 'CategoryController@index')->name('categories.index');
        Route::post('/', 'CategoryController@store')->name('categories.store')->middleware('manager');
        Route::get('/create', 'CategoryController@create')->name('categories.create')->middleware('manager');
        Route::get('/{id}', 'CategoryController@show')->name('categories.show');
        Route::put('/{id}', 'CategoryController@update')->name('categories.update')->middleware('manager');
        Route::delete('/{id}', 'CategoryController@delete')->name('categories.delete')->middleware('manager');
        Route::get('/{id}/edit/', 'CategoryController@edit')->name('categories.edit')->middleware('manager');
    });
    Route::group(['prefix' => 'products'],function (){
        Route::get('/', 'ProductController@index')->name('products.index');
        Route::post('/', 'ProductController@store')->name('products.store')->middleware('manager');
        Route::get('/create', 'ProductController@create')->name('products.create')->middleware('manager');
        Route::get('/{id}', 'ProductController@show')->name('products.show');
        Route::put('/{id}', 'ProductController@update')->name('products.update')->middleware('manager');
        Route::delete('/{id}', 'ProductController@delete')->name('products.delete')->middleware('manager');
        Route::get('/{id}/edit', 'ProductController@edit')->name('products.edit')->middleware('manager');
        Route::get('restore/{id}', 'ProductController@restore')->name('products.restore')->middleware('manager');
    });
    Route::get('/products/search/{query}','ProductController@search')->name('products.search');
    Route::group(['prefix' => 'suppliers'],function (){
        Route::get('/', 'SupplierController@index')->name('suppliers.index');
        Route::post('/', 'SupplierController@store')->name('suppliers.store')->middleware('manager');
        Route::get('/create', 'SupplierController@create')->name('suppliers.create')->middleware('manager');
        Route::get('/emailexist', 'SupplierController@emailexist')->name('suppliers.emailexist');
        Route::get('/phoneexist', 'SupplierController@phoneexist')->name('suppliers.phoneexist');
        Route::post('/storeAjax', 'SupplierController@storeAjax')->name('suppliers.storeAjax');
        Route::get('/{id}', 'SupplierController@show')->name('suppliers.show');
        Route::put('/{id}', 'SupplierController@update')->name('suppliers.update')->middleware('manager');
        Route::delete('/{id}', 'SupplierController@delete')->name('suppliers.delete')->middleware('manager');
        Route::get('/{id}/edit', 'SupplierController@edit')->name('suppliers.edit')->middleware('manager');
    });
    Route::group(['prefix' => 'purchases'],function (){
        Route::get('/', 'PurchaseController@index')->name('purchases.index');
        Route::post('/', 'PurchaseController@store')->name('purchases.store')->middleware('manager');
        Route::get('/create', 'PurchaseController@create')->name('purchases.create')->middleware('manager');;
        Route::get('/{id}', 'PurchaseController@show')->name('purchases.show');
        Route::put('/{id}', 'PurchaseController@update')->name('purchases.update')->middleware('manager');;
        Route::delete('/{id}', 'PurchaseController@delete')->name('purchases.delete')->middleware('manager');;
        Route::get('/{id}/edit', 'PurchaseController@edit')->name('purchases.edit')->middleware('manager');;

    });
    Route::group(['prefix' => 'sales'],function (){
        Route::get('/', 'SaleController@index')->name('sales.index');
        Route::post('/', 'SaleController@store')->name('sales.store');
        Route::get('/create', 'SaleController@create')->name('sales.create');
        Route::get('/{id}', 'SaleController@show')->name('sales.show');
        Route::put('/{id}', 'SaleController@update')->name('sales.update');
        Route::delete('/{id}', 'SaleController@delete')->name('sales.delete');
        Route::get('/{id}/edit', 'SaleController@edit')->name('sales.edit');

    });

Route::group(['prefix' => 'companies'],function (){
    Route::get('/', 'CompanyController@index')->name('companies.index');
    Route::put('/', 'CompanyController@update')->name('companies.update')->middleware('manager');
});
Route::group(['prefix' => 'stock'],function(){
    Route::get('/','CurrentStockController@index')->name('stock.index');
    Route::get('/opening-stock','OpeningStockController@index')->name('opening.stock.index');
    Route::post('/opening-stock','OpeningStockController@store')->name('opening.stock.store');
    Route::get('/{product_id}','CurrentStockController@check')->name('stock.check');
});
    Route::group(['prefix' => 'reports'],function (){
        Route::get('/daily', 'ReportController@daily')->name('reports.sales.daily');
        Route::get('/monthly', 'ReportController@monthly')->name('reports.sales.monthly');
        Route::get('/yearly', 'ReportController@yearly')->name('reports.sales.yearly');
    });
    Route::get('print/sale/{id}','PrintController@printSale')->name('sales.print');
    Route::get('print/purchase/{id}','PrintController@printPurchase')->name('purchases.print');

});

