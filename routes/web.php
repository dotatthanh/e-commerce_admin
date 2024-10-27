<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\ImportOrderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\Web\RegisteredCustomerController;
use App\Http\Controllers\Web\AuthenticatedSessionController;
use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\Web\PasswordResetLinkController;
use App\Http\Controllers\Web\NewPasswordController;
// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', function () {
        return redirect()->route('users.index');
    });

    Route::post('/products/upload-image-details', [ProductController::class, 'uploadImageDetails'])->name('products.upload-image-details');
    Route::post('/products/get-variants/{id}', [ProductController::class, 'getVariants'])->name('products.get-variants');
    Route::post('/products/supplier/{id}', [ProductController::class, 'getProductsBySupplierId'])->name('products.get-variants');
    Route::resource('products', ProductController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('suppliers', SupplierController::class);

    Route::resource('discount-codes', DiscountCodeController::class);

    Route::resource('users', UserController::class);
    Route::get('/users/change-password/{user}', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::post('/users/change-password/{user}', [UserController::class, 'updatePassword'])->name('users.update-password');
    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');

    Route::resource('warehouses', WarehouseController::class);

    Route::resource('import-orders', ImportOrderController::class);

    Route::resource('reports', ReportController::class);

    Route::resource('orders', OrderController::class);
    Route::post('update-status-order/{order}', [OrderController::class, 'updateStatusOrder'])->name('orders.update-status-order');
    Route::post('cancel-order/{order}', [OrderController::class, 'cancelOrder'])->name('orders.cancel-order');

    Route::resource('roles', RoleController::class);

    Route::resource('permissions', PermissionController::class);
});

require __DIR__ . '/auth.php';

Route::name('web.')->prefix('web')->group(function () {
    Route::get('register', [RegisteredCustomerController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredCustomerController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/change-password', [CustomerController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password', [CustomerController::class, 'updatePassword'])->name('update-password');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    Route::get('search', [WebController::class, 'search'])
        ->name('search');
});

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
