<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('admin/login', [LoginController::class, 'loginSubmit'])->name('login.submit');

Route::middleware('auth')->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
});
