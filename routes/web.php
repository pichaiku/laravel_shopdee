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

//customer
Route::get('/admin/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('admin.customer.index');
Route::get('/admin/customer/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('admin.customer.create');
Route::post('/admin/customer', [App\Http\Controllers\CustomerController::class, 'store'])->name('admin.customer.store');
Route::get('/admin/customer/{id}', [App\Http\Controllers\CustomerController::class, 'show'])->name('admin.customer.show');
Route::get('/admin/customer/{id}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('admin.customer.edit');
Route::post('/admin/customer/{id}', [App\Http\Controllers\CustomerController::class, 'update'])->name('admin.customer.update');
Route::delete('/admin/customer/{id}', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('admin.customer.destroy');


//employee
Route::get('/admin/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('admin.employee.index');;
Route::get('/admin/employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('admin.employee.create');
Route::post('/admin/employee', [App\Http\Controllers\EmployeeController::class, 'store'])->name('admin.employee.store');
Route::get('/admin/employee/{id}', [App\Http\Controllers\EmployeeController::class, 'show'])->name('admin.employee.show');
Route::get('/admin/employee/{id}/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('admin.employee.edit');
Route::post('/admin/employee/{id}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('admin.employee.update');
Route::delete('/admin/employee/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('admin.employee.destroy');



Route::get('/houseprice', [App\Http\Controllers\HousePriceController::class, 'index'])->name('houseprice.index');
Route::post('/houseprice/predict', [App\Http\Controllers\HousePriceController::class, 'predict'])->name('houseprice.predict');

Route::get('/showToken', [App\Http\Controllers\CustomerController::class, 'showToken'])->name('customer.showToken');
Route::get('/pushbot', function () {
     return view('pushbot');
 });
 Route::post('/pushbot', [App\Http\Controllers\API\LineBotController::class, 'pushbot']);
 

//Auth::routes();
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
