<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('template.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

    Route::post('/upload-image-details', [ProductController::class, 'uploadImageDetails'])->name('products.upload-image-details');
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('discount-codes', DiscountCodeController::class);
    Route::resource('users', UserController::class);
    Route::get('/users/view-change-password/{user}', [UserController::class, 'viewChangePassword'])->name('users.view-change-password');
    Route::post('/users/change-password/{user}', [UserController::class, 'changePassword'])->name('users.change-password');
});

require __DIR__.'/auth.php';
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
