<?php

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
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index');
    Route::resource('dashboard', 'DashboardController');
    Route::resource('roles', 'RoleController');
    Route::resource('employees', 'EmployeeController');
    Route::resource('employee.salary', 'SalaryController');
    Route::resource('employee.payslips', 'PayslipController');
	Route::get('payslip/{id}/send', 'PayslipController@send');
});

