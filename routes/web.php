<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// user routes
Route::get('/',[UserController::class, 'index']);
Route::post('/login',[UserController::class, 'login'])->name('user.login');
Route::match(['get','post'],'user/register',[UserController::class, 'register'])->name('user.register');
Route::get('/user/dashboard',[UserController::class, 'dashboard'])->name('user.dashboard')->middleware("CustomAuth");
Route::get('/user/country',[UserController::class, 'getCountry'])->name('user.country');
Route::get('/user/state/{id}',[UserController::class, 'getState'])->name('user.state');
Route::get('/user/city/{id}',[UserController::class, 'getCity'])->name('user.city');
Route::get('/user/logout',[UserController::class, 'logout'])->name('user.logout');
