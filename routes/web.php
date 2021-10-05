<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', function (){ return view('admin.index');} )->middleware('auth');

Route::get('/admin/attendances', [App\Http\Controllers\AttendanceController::class, 'index'] )->name('attendance.index')->middleware('auth');
Route::get('/admin/attendances/create',[App\Http\Controllers\AttendanceController::class, 'create'])->name('attendance.create')->middleware('auth');
Route::get('/admin/attendances/{id}',[App\Http\Controllers\AttendanceController::class, 'show'])->name('attendance.show')->middleware('auth');
Route::delete('/admin/attendances/{id}', [App\Http\Controllers\AttendanceController::class, 'destroy'])->name('attendance.destroy')->middleware('auth');
Route::get('/admin/attendances/edit/{id}',[App\Http\Controllers\AttendanceController::class, 'edit'])->name('attendance.edit')->middleware('auth');
Route::post('/admin/attendances/update',[App\Http\Controllers\AttendanceController::class, 'update'])->name('attendance.update')->middleware('auth');

Route::get('/admin/locations', [App\Http\Controllers\LocationController::class, 'index'] )->name('location.index')->middleware('auth');
Route::get('/admin/locations/create',[App\Http\Controllers\LocationController::class, 'create'])->name('location.create')->middleware('auth');
Route::get('/admin/locations/{id}',[App\Http\Controllers\LocationController::class, 'show'])->name('location.show')->middleware('auth');
Route::post('/admin/locations', [App\Http\Controllers\LocationController::class, 'store'])->name('location.store')->middleware('auth');
Route::delete('/admin/locations/{id}', [App\Http\Controllers\LocationController::class, 'destroy'])->name('location.destroy')->middleware('auth');
Route::get('/admin/locations/edit/{id}',[App\Http\Controllers\LocationController::class, 'edit'])->name('location.edit')->middleware('auth');
Route::post('/admin/locations/update',[App\Http\Controllers\LocationController::class, 'update'])->name('location.update')->middleware('auth');

Route::get('/admin/networks', [App\Http\Controllers\NetworkController::class, 'index'] )->name('network.index')->middleware('auth');
Route::get('/admin/networks/create',[App\Http\Controllers\NetworkController::class, 'create'])->name('network.create')->middleware('auth');
Route::get('/admin/networks/{id}',[App\Http\Controllers\NetworkController::class, 'show'])->name('network.show')->middleware('auth');
Route::post('/admin/networks', [App\Http\Controllers\NetworkController::class, 'store'])->name('network.store')->middleware('auth');
Route::delete('/admin/networks/{id}', [App\Http\Controllers\NetworkController::class, 'destroy'])->name('network.destroy')->middleware('auth');
Route::get('/admin/networks/edit/{id}',[App\Http\Controllers\NetworkController::class, 'edit'])->name('network.edit')->middleware('auth');
Route::post('/admin/networks/update',[App\Http\Controllers\NetworkController::class, 'update'])->name('network.update')->middleware('auth');

Route::get('/admin/users',[App\Http\Controllers\UserController::class, 'index'])->name('user.index')->middleware('auth');
Route::get('/admin/users/create',[App\Http\Controllers\UserController::class, 'create'])->name('user.create')->middleware('auth');
Route::get('/admin/users/{id}',[App\Http\Controllers\UserController::class, 'show'])->name('user.show')->middleware('auth');
Route::delete('/admin/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy')->middleware('auth');
Route::get('/admin/users/edit/{id}',[App\Http\Controllers\UserController::class, 'edit'])->name('user.edit')->middleware('auth');
Route::post('/admin/users/update',[App\Http\Controllers\UserController::class, 'update'])->name('user.update')->middleware('auth');
