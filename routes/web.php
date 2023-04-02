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
//Auth::routes();
Route::get('/', function () {return view('welcome');});

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

//product type
Route::resource('/admin/producttype', App\Http\Controllers\ProductTypeController::class);

//product
Route::resource('/admin/product', App\Http\Controllers\ProductController::class);

//province
Route::resource('/admin/province', App\Http\Controllers\ProvinceController::class);

//district
Route::resource('/admin/district', App\Http\Controllers\DistrictController::class);

//subdistrict
Route::resource('/admin/subdistrict', App\Http\Controllers\SubdistrictController::class);

Route::get('/houseprice', [App\Http\Controllers\HousePriceController::class, 'index'])->name('houseprice.index');
Route::post('/houseprice/predict', [App\Http\Controllers\HousePriceController::class, 'predict'])->name('houseprice.predict');

Route::get('/showToken', [App\Http\Controllers\CustomerController::class, 'showToken'])->name('customer.showToken');
Route::post('/pushbot', [App\Http\Controllers\API\LineBotController::class, 'pushbot']);
 


