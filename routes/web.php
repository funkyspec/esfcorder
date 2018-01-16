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

Route::get('/offer/latestoffer', 'OfferController@latest');
Route::post('/offer/checkmember', 'OfferController@checkMember');
Route::resource('offers', 'OfferController');

//Route::get('/offer/{id}', 'OfferController@available');


Route::get('/order/create/{offer_id}/{orderemail}/{mbr}', 'OrderController@create');
Route::post('/order/startorder', 'OrderController@startOrder');
Route::resource('orders', 'OrderController');
