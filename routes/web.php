<?php

use App\Http\Controllers\Admin\AdminController;
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

Route::middleware(['auth', 'activity'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('user_profile/{id}/edit', [UserProfileController::class, 'edit'])->name('user_profile.edit');
    Route::patch('user_profile/{id}', [UserProfileController::class, 'update'])->name('user_profile.update');
    route::get('index', [UserProfileController::class, 'mange'])->name('mange.index');
    route::get('notify/{id}', [MessageController::class, 'notify'])->name('notify.read');
});
Route::middleware('activity')->group(function () {
    Route::get('user_profile/{id}', [UserProfileController::class, 'index'])->name('user_profile.index');
    Route::get('admin/allusers', [AdminController::class, 'Alluser'])->name('admin.allusers')->middleware('auth', 'admin');
    Route::delete('admin/allusers/{id}', [AdminController::class, 'destroy'])->name('delete.admin.allusers')->middleware('auth', 'admin');
    Route::post('admin/allusers/{id}', [AdminController::class, 'makeadmin'])->name('make.admin.allusers')->middleware('auth', 'admin');
    Route::get('/', [ListingController::class, 'index']);
    Route::resource('listings', ListingController::class);
    // Route::resource('listings', ListingController::class)->parameters([
    //     'show' => 'title',
    // ]);

});

route::resource('message', MessageController::class)->middleware('auth');

require __DIR__ . '/auth.php';