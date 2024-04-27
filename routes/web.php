<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// GoogleLoginController redirect and callback urls
Route::get('/login/google', [GoogleLoginController::class, 'redirectToProvider'])->name('auth.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleProviderCallback']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::middleware(['auth', 'activity'])->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
            Route::get('user_profile/{id}/edit', [UserProfileController::class, 'edit'])->name('user_profile.edit');
            Route::patch('user_profile/{id}', [UserProfileController::class, 'update'])->name('user_profile.update');
            route::get('index', [UserProfileController::class, 'mange'])->name('mange.index');
            route::get('notify/{id}', [MessageController::class, 'notify'])->name('notify.read');
            Route::get('admin/allusers', [AdminController::class, 'Alluser'])->name('admin.allusers')->middleware('admin');
            Route::delete('admin/allusers/{id}', [AdminController::class, 'destroy'])->name('delete.admin.allusers')->middleware('admin');
            Route::post('admin/allusers/{id}', [AdminController::class, 'makeadmin'])->name('make.admin.allusers')->middleware('admin');
            Route::get('listing/trash', [ListingController::class, 'trash'])->name('listing.trash');
            Route::put('listings/{title}/trash/restore', [ListingController::class, 'restore'])->name('listing.restore');
            Route::delete('listings/{title}/trash/delete', [ListingController::class, 'force_delete'])->name('listing.force_delete');
        });
        Route::get('user_profile/{id}', [UserProfileController::class, 'index'])->name('user_profile.index');
        Route::get('/', [ListingController::class, 'index']);
        Route::resource('listings', ListingController::class);

        route::resource('message', MessageController::class)->middleware('auth');
    }
);
require __DIR__ . '/auth.php';
