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


Route::get('/', function () {
    return view('welcome');
});  */

//auth routes:

Route::view('/', 'welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/offers/latestoffer', 'OfferController@latest')->name('latest');
Route::post('/offers/checkmember', 'OfferController@checkMember');
Route::get('/offers/total/{id}', 'OfferController@producerTotal');
Route::resource('offers', 'OfferController');

//Route::get('/offer/{id}', 'OfferController@available');


Route::get('/orders/create/{offer_id}', 'OrderController@create');
Route::get('/orders/cancel/{id}', 'OrderController@cancel');
Route::post('/orders/confirm', 'OrderController@confirm');
Route::resource('orders', 'OrderController');
