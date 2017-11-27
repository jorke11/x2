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

require __DIR__ . '/administration.php';



