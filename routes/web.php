<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('user_profile/{id}', [UserProfileController::class, 'index'])->name('user_profile.index');
    Route::get('user_profile/{id}/edit', [UserProfileController::class, 'edit'])->name('user_profile.edit');
    Route::patch('user_profile/{id}', [UserProfileController::class, 'update'])->name('user_profile.update');
});
Route::middleware('activity')->group(function () {
    Route::get('/', [ListingController::class, 'index']);
    Route::resource('listings', ListingController::class);
    // Route::resource('listings', ListingController::class)->parameters([
    //     'show' => 'title',
    // ]);

});

route::resource('message', MessageController::class)->middleware('auth');

require __DIR__ . '/auth.php';
