<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PasswordController;
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

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');

Route::post('/store', [RegisterController::class, 'store'])->name('store');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/change-password', [PasswordController::class, 'index'])->name('change.password');

    Route::post('/update-password', [PasswordController::class, 'store'])->name('update.password');
});

Route::middleware(['auth', 'verified', 'is_admin'])->group(function () {

    Route::get('/admin', [HomeController::class, 'admin'])->name('admin');

    Route::resource('employees', EmployeeController::class);
});
