<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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


Route::get('/family', [App\Http\Controllers\FamilyController::class, 'family']);
Route::get('/compute', [App\Http\Controllers\FamilyController::class, 'compute'])->name('family.compute');


//Route::get('/employee', 'EmployeeController@index')->name('employee.index');
// Route::get('/employee/view/{id}', 'EmployeeController@view')->name('employee.view');
// Route::get('/employee/add', 'EmployeeController@add')->name('employee.add');
// Route::get('/employee/edit/{id}', 'EmployeeController@edit')->name('employee.edit');
// Route::post('/employee/create', 'EmployeeController@create')->name('employee.create');
// Route::put('/employee/update/{id}', 'EmployeeController@update')->name('employee.update');
// Route::get('/employee/delete/{id}', 'EmployeeController@delete')->name('employee.delete');
// Route::get('/employee/district/{id}','EmployeeController@district');
// Route::get('/employee/subdistrict/{id}','EmployeeController@subdistrict');