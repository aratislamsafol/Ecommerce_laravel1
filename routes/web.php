<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\FirstController;

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
// Add Product
Route::get('admin/product/add','Admin\ProductController@AddProduct')->name('add.product');
Route::post('admin/product/store','Admin\ProductController@StoreProduct')->name('admin.product.store');
// manage Product
Route::get('admin/product/show','Admin\ProductController@ShowProduct')->name('manage.product');
Route::get('admin/product/edit/{id}','Admin\ProductController@Edit');
Route::post('admin/brand/edit/item/{id}','Admin\ProductController@Update');
Route::get('admin/product/delete/{id}','Admin\ProductController@Delete');
Route::get('admin/brand/item/inactive/{id}','Admin\ProductController@Inactive');
Route::get('admin/brand/item/active/{id}','Admin\ProductController@Active');

// =======================Coupon=========================================
Route::get('admin/coupon','Admin\CouponController@Index')->name('admin.coupon');
Route::post('admin/coupon/add','Admin\CouponController@AddCoupon')->name('store.coupon');
Route::get('admin/coupon/item/{id}','Admin\CouponController@Edit');
Route::post('admin/coupon/edit/item/{id}','Admin\CouponController@Update');
Route::get('admin/coupon/item/delete/{id}','Admin\CouponController@Delete');
Route::get('admin/coupon/item/inactive/{id}','Admin\CouponController@Inactive');
Route::get('admin/coupon/item/active/{id}','Admin\CouponController@Active');

// =========================Orders================================================
Route::get('admin/orders','Admin\OrderController@Index')->name('admin.orders');
Route::get('admin/order/view/{id}','Admin\OrderController@ViewOrder');

// =========================Fontend================================================
// =========================Cart================================================
Route::post('product/shopping/cart/add/{id}','CartController@AddCart');
Route::get('cart','CartController@ShowCart');
Route::get('cart/destroy/{id}','CartController@Remove');
Route::post('cart/item/update/{id}','CartController@UpdateCart');
// Cart Coupon
Route::Get('cart/cuppon/apply','CartController@ApplyCoupon');

// ============================Wishlist==============================================
Route::get('product/add/wishlist/{id}','WishlistController@AddWishlist');
Route::get('product/show/wishlist','WishlistController@ShowWishlist');
Route::get('wl/destroy/{id}','WishlistController@Remove');

// ============================ Product Details ============================================
Route::get('product/details/{id}','FontendController@ProductDetails');
Route::get('coupon/destroy','CartController@CouponDestroy');
Route::get('shop','FontendController@ShopShow')->name('shop.pages');

// CategoryWise Product Show
Route::get('category/show/all_items/{id}','FontendController@CategoryWiseShow');

// ============================ Checkout ============================================
Route::get('checkout','CheckoutController@Index');

// ============================ Order Data ==========================================
Route::post('place/order','OrderController@StoreData');
Route::get('order/success','OrderController@SuccessPages');
Route::get('total/orders','OrderController@OrderCart')->name('orders');
Route::get('order/item/show/{id}','OrderController@OrderFontendShow');

// ==================SSl Commerze====================
// SSLCOMMERZ Start
Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'SslCommerzPaymentController@index');
Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END


