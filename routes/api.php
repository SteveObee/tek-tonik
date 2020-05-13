<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//   return $request->user();
// });

Route::get('/user', function (Request $request) {
  return $request->user();
});

Route::namespace('Api')->group(function () {
  Route::post('/users/token', 'UsersController@getToken');

  Route::middleware('auth:sanctum')->group(function () {
    # User routes
    Route::get('/users', 'UsersController@index');
    Route::get('/users/addresses', 'UsersController@userAddresses');
    Route::post('/users', 'UsersController@store');

    Route::get('/users/{user}', 'UsersController@show');
    Route::put('/users/{user}', 'UsersController@update');
    Route::delete('/users/{user}', 'UsersController@destroy');

    # Address routes
    Route::get('/addresses', 'AddressesController@index');

    Route::post('/addresses', 'AddressesController@store');
    Route::get('/addresses/{address}', 'AddressesController@show');
    Route::put('/addresses/{address}', 'AddressesController@update');
    Route::delete('/addresses/{address}', 'AddressesController@destroy');

    # Product routes
    Route::get('/products', 'ProductsController@index');
    Route::get('/products/{product}', 'ProductsController@show');
    Route::delete('/products/{product}', 'ProductsController@destroy');
  });
});
