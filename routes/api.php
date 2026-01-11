<?php

use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DesignationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/departmetns', [DepartmentController::class, 'getData']);
Route::post('/departments/store', [DepartmentController::class, 'store']);
Route::get('/departments/edit/{id}', [DepartmentController::class, 'edit']);
Route::put('/departments/update/{id}', [DepartmentController::class, 'update']);
Route::delete('/departments/delete/{id}', [DepartmentController::class, 'destroy']);

Route::get('/designations/', [DesignationController::class, 'index']);
Route::post('/designations/store', [DesignationController::class, 'store']);
Route::get('/designations/edit/{id}', [DesignationController::class, 'edit']);
Route::put('/designations/update/{id}', [DesignationController::class, 'update']);
Route::delete('/designations/delete/{id}', [DesignationController::class, 'destroy']);


