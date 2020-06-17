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

Route::group(['prefix' => 'admin-page', 'namespace' => 'adminka', 'middleware' => ['auth','role']],function (){
    Route::view('/','home');
    Route::resource('/product','ProductController');
    Route::resource('/category','CategoryController');
    Route::resource('/brand','BrandController');
    Route::resource('/color','ColorController');
    Route::resource('/slider','SliderController');
    Route::resource('/year','YearController');
    Route::post('/slider/update-order','SliderController@change_image_order')->name('update-order');
    Route::get('/orders','OrdersController@index')->name('orders');
    Route::get('/show_products/{id}','OrdersController@show')->name('show_products');
});

Auth::routes();

Route::get('/','FrontController@index')->name('front');

Route::get('/home', 'FrontController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/user','UserController@index')->name('user');
    Route::post('/avatar','UserController@change_avatar')->name('avatar');
    Route::put('/update_profile','UserController@update')->name('update_profile');
    Route::get('/cart','CartController@index')->name('cart');
    Route::post('/card-url','CartController@add')->name('add-to-cart');
    Route::post('/hide-product','CartController@hide_product')->name('hide-product');
    Route::get('/wish_list','WishListController@index')->name('wish_list');
    Route::post('/add_to_wish_list','WishListController@add')->name('add_to_wish_list');
    Route::post('/hide-product-wish-list','WishListController@hide_product')->name('hide-product-wish-list');
    Route::get('/checkout','CheckoutController@index')->name('checkout');
    Route::post('/check_out','CheckoutController@store')->name('checkout.store');
    Route::get('/thank_you','ConfirmationController@index')->name('thank_you');
    Route::post('/coupon','CouponsController@store')->name('coupon.store');
    Route::delete('/coupon_rem','CouponsController@destroy')->name('coupon.destroy');
    Route::get('/my_orders/{id}','OrdersController@index')->name('my_orders');
});


Route::get('/products','ProductListController@allProducts')->name('products');
Route::get('/product/{id}','ProductListController@singleProduct')->name('product');
Route::get('/search','ProductListController@search')->name('search');
Route::get('/category/{id}', 'ProductListController@categoryItems')->name('category');
Route::get('/brand/{id}', 'ProductListController@brandItems')->name('brand');
Route::get('/color/{id}', 'ProductListController@colorItems')->name('color');
Route::get('/year/{id}', 'ProductListController@yearItems')->name('year');
Route::get('/productsPr','ProductListController@productsPr')->name('productsPr');
Route::get('/all_sections','ProductListController@allSections')->name('all_sections');
Route::get('/actions','ProductListController@actions')->name('actions');
Route::post('/email','EmailAvailable@check');
Route::post('/validation','ValidController@validator')->name('valid');
Route::get('/sort_price','ProductListController@sort_price')->name('sort_price');





