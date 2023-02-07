<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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
// Route::get('/sdfs', function () {
//     return view('product');
// });
 
// Route::get('/product', [App\Http\Controllers\ProductController::class, 'show']);
 

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'products',
], function () {
    Route::get('/', [ProductsController::class, 'index'])
         ->name('products.product.index');
    Route::get('/create', [ProductsController::class, 'create'])
         ->name('products.product.create');
    Route::get('/show/{product}',[ProductsController::class, 'show'])
         ->name('products.product.show')->where('id', '[0-9]+');
    Route::get('/{product}/edit',[ProductsController::class, 'edit'])
         ->name('products.product.edit')->where('id', '[0-9]+');
    Route::post('/', [ProductsController::class, 'store'])
         ->name('products.product.store');
    Route::put('product/{product}', [ProductsController::class, 'update'])
         ->name('products.product.update')->where('id', '[0-9]+');
    Route::delete('/product/{product}',[ProductsController::class, 'destroy'])
         ->name('products.product.destroy')->where('id', '[0-9]+');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
