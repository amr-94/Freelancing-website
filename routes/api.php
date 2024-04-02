<?php

use App\Http\Controllers\Api\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//  Route::apiResource('listings', ListingController::class);
route::get('listings', [ListingController::class, 'index']);
route::post('listings', [ListingController::class, 'store']);
route::post('listings/{id}', [ListingController::class, 'update']);
route::delete('listings/{id}', [ListingController::class, 'destroy']);