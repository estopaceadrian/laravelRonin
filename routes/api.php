<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
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

Route::post('register','App\Http\Controllers\API\AuthController@register');
Route::post('login','App\Http\Controllers\API\AuthController@login');

Route::middleware(['auth:sanctum'])->group(function(){

    Route::post('logout','App\Http\Controllers\API\AuthController@logout');

});

//Product
Route::get('getScooter','App\Http\Controllers\API\StoreController@getScooter');
Route::get('getHelmet','App\Http\Controllers\API\StoreController@getHelmet');
Route::get('getAccessory','App\Http\Controllers\API\StoreController@getAccessory');
Route::get('viewproductdetail/{id}','App\Http\Controllers\API\StoreController@viewProduct');

//Cart
Route::post('add-to-cart','App\Http\Controllers\API\CartController@addtocart');
Route::get('cart','App\Http\Controllers\API\CartController@viewcart');
Route::put('cart-updatequantity/{cart_id}/{scope}','App\Http\Controllers\API\CartController@updatequantity');
Route::delete('delete-cartItem/{cart_id}','App\Http\Controllers\API\CartController@deleteCartItem');

//Checkout
Route::post('place-order' ,'App\Http\Controllers\API\CheckoutController@placeorder');

//Admin - Orders
Route::get('admin/orders' ,'App\Http\Controllers\API\OrderController@orders');

//Admin - Products
Route::post('store-product', 'App\Http\Controllers\API\ProductController@store');
Route::get('view-product', 'App\Http\Controllers\API\ProductController@index');
Route::get('edit-product/{id}','App\Http\Controllers\API\ProductController@edit' );
Route::post('update-product/{id}','App\Http\Controllers\API\ProductController@update' );



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
