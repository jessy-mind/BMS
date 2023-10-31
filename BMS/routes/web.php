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


Route::get('/get_products', 'Controller@getproducts');

Route::post('/edit_product', 'Controller@editProduct');

Route::post('/add_new_product', 'Controller@addNewProduct');

Route::get('/get_store_admins', 'Controller@getStoreAdmins');

Route::post('/edit_store_admin', 'Controller@editStoreAdmin');

Route::post('/add_new_store_admin', 'Controller@addNewStoreAdmin');

Route::post('/edit_store', 'Controller@editStore');

Route::get('/get_stores', 'Controller@getStores');

Route::post('/add_new_store', 'Controller@addNewStore');

Route::post('/upload_store_picture', 'Controller@uploadStorePicture');

Route::get('/get_super_admins', 'Controller@getSuperAdmins');

Route::post('/edit_super_admin', 'Controller@editSuperAdmin');

Route::post('/add_new_super_admin', 'Controller@addNewSuperAdmin');


Route::get('/logout', 'AuthController@logout')->name('logout');

Route::get('/login', 'AuthController@login')->name('login');

Route::post('/login_data', 'AuthController@loginData')->name('login-data');

Route::post('/logout', 'AuthController@logout');

Route::get('/', 'Controller@home')->name('home');

Route::any('/{slug}', 'Controller@index');
