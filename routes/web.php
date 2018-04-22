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

Auth::routes();

Route::get('/wishlists/{wishlist}', 'WishlistController@show')->name('show-wishlist');

Route::get('/wishlists', 'WishlistController@index')->name('show-mywishlist')->middleware('auth');

Route::post('/wishlists/{product}', 'WishlistController@store')->name('product-whislist')->middleware('auth');

Route::post('/wishlists/delete/{product}', 'WishlistController@destroy')->name('product-whislist-delete')->middleware('auth');

Route::get('/products/sync', 'ProductController@sync');

Route::get('/', 'HomeController@index')->name('home');
