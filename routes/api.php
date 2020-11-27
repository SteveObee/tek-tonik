<?php

use App\Http\Controllers\Api\AdminController;
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
    # Admin Auth routes
    Route::get('/users', 'UsersController@index');
    Route::get('/users/addresses', 'UsersController@userAddresses');
    Route::get('/users/orders', 'UsersController@userOrders');
    Route::get('/users/basket', 'UsersController@userBasket');
    Route::get('/users/addresses/all', 'UsersController@allUserAddresses');
    Route::post('/users', 'UsersController@store');

    Route::get('/users/{user}', 'UsersController@show');
    Route::put('/users/{user}', 'UsersController@update');
    Route::delete('/users/{user}', 'UsersController@destroy');
    Route::post('/users/charge', 'UsersController@chargeUser');

    # Address routes
    Route::get('/addresses', 'AddressesController@index');

    Route::post('/addresses', 'AddressesController@store');
    Route::get('/addresses/{address}', 'AddressesController@show');
    Route::put('/addresses/{address}', 'AddressesController@update');
    Route::delete('/addresses/{address}', 'AddressesController@destroy');
  });

  # Order routes
  Route::get('/orders', 'OrdersController@index');
  Route::get('/orders/stripekey', 'OrdersController@stripeKey');
  Route::post('/orders/create', 'OrdersController@store');
  Route::put('/orders/{order}', 'OrdersController@update');

  Route::post('/orders/additem', 'OrderItemsController@store');
  Route::get('/orders/placed/{order}', 'OrdersController@placed');

  # Admin routes
  Route::post('admin/contact', 'AdminController@contact');

  # Product routes
  Route::get('/products', 'ProductsController@index');
  Route::get('/products/category/{category}', 'ProductsController@productsByCategory');

  Route::get('/products/{product}', 'ProductsController@show');
  Route::get('/products/{product}/images', 'ProductsController@productImages');
  Route::get('/products/{product}/quantity', 'ProductsController@productQuantity');
  Route::post('/products/{product}/quantity', 'ProductsController@updateQuantity');
  Route::delete('/products/{product}', 'ProductsController@destroy');

  # Category routes
  Route::get('/categories', 'CategoriesController@index');
  Route::get('/categories/recursed', 'CategoriesController@recursed');
  Route::get('/categories/{category}', 'CategoriesController@recursiveCategoryIds');

  # Brand routes
  Route::get('/brands', 'BrandsController@index');
});
