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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/createCategory', 'Admin\CategoryController@index');
Route::post('/admin/createCategory', 'Admin\CategoryController@store');
Route::get('/admin/editCategory/{id}', 'Admin\CategoryController@edit');
Route::post('/admin/updateCategory/{id}', 'Admin\CategoryController@update');
Route::get('/admin/deleteCategory/{id}', 'Admin\CategoryController@delete');

Route::get('/admin/createProduct', 'Admin\ProductController@create');
Route::get('/admin/dashboard', 'Admin\ProductController@index');
Route::get('/admin/editProduct/{id}', 'Admin\ProductController@edit');
Route::post('/admin/updateProduct/{id}', 'Admin\ProductController@update');
Route::get('/admin/editProductImage/{id}', 'Admin\ProductController@editImage');
Route::post('/admin/updateProductImage/{id}', 'Admin\ProductController@updateImage');
Route::get('/admin/deleteProduct/{id}', 'Admin\ProductController@delete');
Route::post('/admin/createProduct', 'Admin\ProductController@store');
