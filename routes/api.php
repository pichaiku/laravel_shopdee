<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('houseprice/predict', [App\Http\Controllers\API\HousePriceController::class, 'predict']);


Route::post('chatbot', [App\Http\Controllers\API\LineBotController::class, 'imageChatbot']);
Route::post('pushbot', [App\Http\Controllers\API\LineBotController::class, 'pushBot']);


Route::get('product', [App\Http\Controllers\API\ProductController::class, 'index']);
Route::post('login', [App\Http\Controllers\API\CustomerController::class, 'login']);
Route::post('register', [App\Http\Controllers\API\CustomerController::class, 'register']);
Route::get('profile/{id}', [App\Http\Controllers\API\CustomerController::class, 'profile']);
Route::post('customer', [App\Http\Controllers\API\CustomerController::class, 'update']);
//Route::get('product', [App\Http\Controllers\API\ProductController::class, 'index']);
Route::get('product/{id}', [App\Http\Controllers\API\ProductController::class, 'show']);
Route::post('order', [App\Http\Controllers\API\OrderController::class, 'order']);
Route::get('orderlist/{id}', [App\Http\Controllers\API\OrderController::class, 'orderlist']);
Route::get('orderinfo/{id}', [App\Http\Controllers\API\OrderController::class, 'orderinfo']);
Route::get('orderdetail/{id}', [App\Http\Controllers\API\OrderdetailController::class, 'orderdetail']);
Route::post('confirmorder', [App\Http\Controllers\API\OrderController::class, 'confirmorder']);

Route::get('monthlySale/{id}', [App\Http\Controllers\API\ReportController::class, 'monthlySale']);
Route::get('topFiveProduct/{id}', [App\Http\Controllers\API\ReportController::class, 'topFiveProduct']);
Route::get('cart/{id}', [App\Http\Controllers\API\OrderController::class, 'cart']);

//payment
Route::post('payment', [App\Http\Controllers\API\PaymentController::class, 'payment']);
// Route::get('payment', [App\Http\Controllers\API\PaymentController::class, 'index']);
// Route::get('payment/{id}', [App\Http\Controllers\API\PaymentController::class, 'view']);
// Route::put('payment/{id}', [App\Http\Controllers\API\PaymentController::class, 'update']);


//Route::resource('photos', [App\Http\Controllers\API\CustomerController::class, 'update']);
Route::group([
    'prefix' => 'products',
], function () {
    Route::get('/', [ProductsController::class, 'index'])
         ->name('api.products.product.index');
    Route::get('/show/{product}',[ProductsController::class, 'show'])
         ->name('api.products.product.show')->where('id', '[0-9]+');
    Route::post('/', [ProductsController::class, 'store'])
         ->name('api.products.product.store');    
    Route::put('product/{product}', [ProductsController::class, 'update'])
         ->name('api.products.product.update')->where('id', '[0-9]+');
    Route::delete('/product/{product}',[ProductsController::class, 'destroy'])
         ->name('api.products.product.destroy')->where('id', '[0-9]+');
});
