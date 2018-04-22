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

Route::get('/wishlist', 'WishlistController@index')->name('wishlist')->middleware('auth');;

Route::get('/wishlist/{wishlist}', 'WishlistController@show')->name('show-wishlist');

Route::post('/wishlist/{product}', 'WishlistController@store')->name('product-whislist');

Route::post('/wishlist/delete/{product}', 'WishlistController@destroy')->name('product-whislist-delete');

Route::get('/', 'HomeController@index')->name('home');
