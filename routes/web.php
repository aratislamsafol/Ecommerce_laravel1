<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Route::get('/','FontendController@Index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ==========================Admin======================================
Route::get('admin/home','AdminController@index');
Route::get('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin','Admin\LoginController@login');
Route::get('admin/logout','AdminController@Logout')->name('admin.logout');

// ========================Category======================================
Route::get('admin/category','Admin\CategoryController@Index')->name('admin.category');
Route::post('admin/category/add','Admin\CategoryController@Store')->name('store.category');
Route::get('admin/category/item/{id}','Admin\CategoryController@Edit');
Route::post('admin/category/edit/item/{id}','Admin\CategoryController@Update');
Route::get('admin/category/item/delete/{id}','Admin\CategoryController@Delete');
Route::get('admin/category/item/inactive/{id}','Admin\CategoryController@Inactive');
Route::get('admin/category/item/active/{id}','Admin\CategoryController@Active');

// ========================Brand======================================
Route::get('admin/brand','Admin\BrandController@Index')->name('admin.brand');
Route::post('admin/brand/add','Admin\BrandController@AddBrand')->name('add.brand');
Route::get('admin/brand/item/{id}','Admin\BrandController@Edit');
Route::post('admin/brand/edit/item/{id}','Admin\BrandController@Update');
Route::get('admin/brand/item/delete/{id}','Admin\BrandController@Delete');
Route::get('admin/brand/item/restore/{id}','Admin\BrandController@Restore');
Route::get('admin/brand/item/p_delete/{id}','Admin\BrandController@PDelete');
Route::get('admin/brand/item/inactive/{id}','Admin\BrandController@Inactive');
Route::get('admin/brand/item/active/{id}','Admin\BrandController@Active');

// =======================Product=========================================
Route::get('admin/product/add','Admin\ProductController@AddProduct')->name('add.product');
