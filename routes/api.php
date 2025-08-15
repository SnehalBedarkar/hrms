<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/roles', [RoleController::class, 'index']);
Route::post('/roles/store', [RoleController::class, 'store']);
Route::get('/roles/edit/{id}', [RoleController::class, 'edit']);

Route::get('/users', [UserController::class, 'index']);
Route::post('/users/store', [UserController::class, 'store']);
