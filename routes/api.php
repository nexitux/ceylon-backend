<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminCategoryController;
use App\Http\Controllers\Api\AdminSubCategoryController;

use App\Http\Controllers\Api\AdminAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

// Admin Authentication
Route::post('admin/register', [AdminAuthController::class, 'register']);
Route::post('admin/login', [AdminAuthController::class, 'login']);

Route::middleware('auth:admin')->group(function () {
    Route::post('admin/logout', [AdminAuthController::class, 'logout']);
    Route::post('admin/refresh', [AdminAuthController::class, 'refresh']);
    Route::post('admin/me', [AdminAuthController::class, 'me']);
});

// Public Read-Only API (Using Admin Controller methods)
Route::get('categories', [AdminCategoryController::class, 'index']);
Route::get('categories/{id}', [AdminCategoryController::class, 'show']);

Route::get('sub-categories', [AdminSubCategoryController::class, 'index']);
Route::get('sub-categories/{id}', [AdminSubCategoryController::class, 'show']);

// Admin API (Full CRUD) - Protected
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    // Categories
    Route::get('categories', [AdminCategoryController::class, 'index']);
    Route::post('categories', [AdminCategoryController::class, 'store']);
    Route::get('categories/{id}', [AdminCategoryController::class, 'show']);
    Route::put('categories/{id}', [AdminCategoryController::class, 'update']);
    Route::delete('categories/{id}', [AdminCategoryController::class, 'destroy']);

    // Sub-Categories
    Route::get('sub-categories', [AdminSubCategoryController::class, 'index']);
    Route::post('sub-categories', [AdminSubCategoryController::class, 'store']);
    Route::get('sub-categories/{id}', [AdminSubCategoryController::class, 'show']);
    Route::put('sub-categories/{id}', [AdminSubCategoryController::class, 'update']);
    Route::delete('sub-categories/{id}', [AdminSubCategoryController::class, 'destroy']);
});
