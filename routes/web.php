<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\EmployeesController;

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

Route::get('/showToken', [App\Http\Controllers\CustomerController::class, 'showToken'])->name('customer.showToken');
Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
Route::get('/customer/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customer.create');
Route::post('/customer', [App\Http\Controllers\CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer/{id}', [App\Http\Controllers\CustomerController::class, 'show'])->name('customer.show');

Route::get('/customer/{id}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit');
Route::post('/customer/{id}', [App\Http\Controllers\CustomerController::class, 'update'])->name('customer.update');


Route::delete('/customer/{id}', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('customer.destroy');

Route::get('/houseprice', [App\Http\Controllers\HousePriceController::class, 'index'])->name('houseprice.index');
Route::post('/houseprice/predict', [App\Http\Controllers\HousePriceController::class, 'predict'])->name('houseprice.predict');


Route::get('/pushbot', function () {
     return view('pushbot');
 });
 Route::post('/pushbot', [App\Http\Controllers\API\LineBotController::class, 'pushbot']);
 

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
 
Route::get('/product', [App\Http\Controllers\ProductController::class, 'show']);
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


Route::group([
    'prefix' => 'customers',
], function () {
    Route::get('/', [CustomersController::class, 'index'])
         ->name('customers.customer.index');
    Route::get('/create', [CustomersController::class, 'create'])
         ->name('customers.customer.create');
    Route::get('/show/{customer}',[CustomersController::class, 'show'])
         ->name('customers.customer.show')->where('id', '[0-9]+');
    Route::get('/{customer}/edit',[CustomersController::class, 'edit'])
         ->name('customers.customer.edit')->where('id', '[0-9]+');
    Route::post('/', [CustomersController::class, 'store'])
         ->name('customers.customer.store');
    Route::put('customer/{customer}', [CustomersController::class, 'update'])
         ->name('customers.customer.update')->where('id', '[0-9]+');
    Route::delete('/customer/{customer}',[CustomersController::class, 'destroy'])
         ->name('customers.customer.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'employees',
], function () {
    Route::get('/', [EmployeesController::class, 'index'])
         ->name('employees.employee.index');
    Route::get('/create', [EmployeesController::class, 'create'])
         ->name('employees.employee.create');
    Route::get('/show/{employee}',[EmployeesController::class, 'show'])
         ->name('employees.employee.show')->where('id', '[0-9]+');
    Route::get('/{employee}/edit',[EmployeesController::class, 'edit'])
         ->name('employees.employee.edit')->where('id', '[0-9]+');
    Route::post('/', [EmployeesController::class, 'store'])
         ->name('employees.employee.store');
    Route::put('employee/{employee}', [EmployeesController::class, 'update'])
         ->name('employees.employee.update')->where('id', '[0-9]+');
    Route::delete('/employee/{employee}',[EmployeesController::class, 'destroy'])
         ->name('employees.employee.destroy')->where('id', '[0-9]+');
});
