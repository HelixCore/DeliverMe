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

Route::get('/', 'HomeController@index')->name('home');



Route::group(['middleware' => ['auth']], function () {
    Route::post('addCard', 'HomeController@addCar')->name('addCar');
    Route::get('wachCar', 'CartController@index')->name('carrito');
    Route::post('processOrder', 'OrderController@process')->name('processOrder');
    Route::post('extract', 'CartController@extract' )->name('extract');
    Route::resource('item', 'ItemController');
    Route::resource('extra', 'ExtraController');
});
