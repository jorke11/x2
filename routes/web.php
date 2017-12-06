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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/qr', 'HomeController@qr');

Route::group(['namespace' => 'Api'], function () {
    Route::post('/user/login', 'UserController@login');
    Route::get('/getUsers', 'UserController@getUsers')->middleware('auth:api');
    Route::get('getUser', 'UserController@getUser')->middleware('auth:api');
    Route::resource("binnacle", "BinnacleController");
    Route::post('newRoute', 'RoutesController@newRoute')->middleware('auth:api');
    Route::get('getRoutes', 'RoutesController@getRoute')->middleware('auth:api');
    Route::post('newPoint', 'PointsController@newPoint')->middleware('auth:api');
    Route::get('getPoints/{id}', 'PointsController@getPoints')->middleware('auth:api');
    Route::post('pairRoute', 'PointsController@pairRoute')->middleware('auth:api');
    Route::get('getRoutesUser', 'RoutesController@getRoutesUser')->middleware('auth:api');
});


Route::get('/api/getCity', 'Administration\SeekController@getCity');
Route::get('/api/getDepartment', 'Administration\SeekController@getDepartment');
Route::get('/api/getSupplier', 'Administration\SeekController@getSupplier');
Route::get('/api/getStakeholder', 'Administration\SeekController@getStakeholder');
Route::get('/api/getCharacteristic', 'Administration\SeekController@getCharacteristic');
Route::get('/api/getClient', 'Administration\SeekController@getClient');
Route::get('/api/getContact', 'Administration\SeekController@getContact');
Route::get('/api/getWarehouse', 'Administration\SeekController@getWarehouse');
Route::get('/api/getWarehouseProduct', 'Administration\SeekController@getWarehouseProduct');
Route::get('/api/getResponsable', 'Administration\SeekController@getResponsable');
Route::get('/api/getProduct', 'Administration\SeekController@getProduct');
Route::get('/api/getService', 'Administration\SeekController@getServices');
Route::get('/api/getCategory', 'Administration\SeekController@getCategory');
Route::get('/api/getNotification', 'Administration\SeekController@getNotification');
Route::get('/api/getCommercial', 'Administration\SeekController@getCommercial');
Route::get('/api/getBranch', 'Administration\SeekController@getBranch');
Route::get('/api/getAccount', 'Administration\SeekController@getAccount');


require __DIR__ . '/administration.php';
require __DIR__ . '/security.php';




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
