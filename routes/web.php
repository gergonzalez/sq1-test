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

Route::get('/wishlist', 'WishlistController@index')->name('wishlist');

Route::get('/wishlist/{user}', 'WishlistController@show');

Route::post('/wishlist/{product}', 'WishlistController@store')->name('product-whislist');

Route::post('/wishlist/delete/{product}', 'WishlistController@destroy')->name('product-whislist-delete');

Route::get('/', 'HomeController@index')->name('home');
