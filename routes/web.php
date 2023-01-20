<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/about', function () {
    return view('about');
});


Route::get('/product', [App\Http\Controllers\ProductController::class, 'show']);












// Route::post('/login', [App\Http\Controllers\EmployeeController::class, 'login'])->name('employee.login');

// Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.index');
// Route::get('/employee/view/{id}', [App\Http\Controllers\EmployeeController::class, 'view'])->name('employee.view');
// Route::get('/employee/add', [App\Http\Controllers\EmployeeController::class, 'add'])->name('employee.add');
// Route::get('/employee/edit/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
// Route::get('/employee/district/{id}', [App\Http\Controllers\EmployeeController::class, 'district']);
// Route::get('/employee/subdistrict/{id}', [App\Http\Controllers\EmployeeController::class, 'subdistrict']);

// Route::post('/employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create');
// Route::put('//employee/update/{id}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employee.update');
// Route::delete('/employee/delete/{id}', [App\Http\Controllers\EmployeeController::class, 'delete'])->name('employee.delete');

//Route::get('/employee', 'EmployeeController@index')->name('employee.index');
// Route::get('/employee/view/{id}', 'EmployeeController@view')->name('employee.view');
// Route::get('/employee/add', 'EmployeeController@add')->name('employee.add');
// Route::get('/employee/edit/{id}', 'EmployeeController@edit')->name('employee.edit');
// Route::post('/employee/create', 'EmployeeController@create')->name('employee.create');
// Route::put('/employee/update/{id}', 'EmployeeController@update')->name('employee.update');
// Route::get('/employee/delete/{id}', 'EmployeeController@delete')->name('employee.delete');
// Route::get('/employee/district/{id}','EmployeeController@district');
// Route::get('/employee/subdistrict/{id}','EmployeeController@subdistrict');


// Route::get('/family', [App\Http\Controllers\FamilyController::class, 'family']);
// Route::get('/compute', [App\Http\Controllers\FamilyController::class, 'compute'])->name('family.compute');
