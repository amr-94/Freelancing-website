<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
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
});

Route::resource('listings', ListingController::class)->middleware('activity');
// Route::resource('listings', ListingController::class)->parameters([
//     'show' => 'title',
// ]);
route::resource('message', MessageController::class)->middleware('auth');
// route::post('message/{id}', [MessageController::class, 'send'])->name('message.send')->middleware('auth');

require __DIR__ . '/auth.php';