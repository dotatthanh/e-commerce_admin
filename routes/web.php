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
use App\Http\Controllers\Web\AuthenticatedSessionController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CategoryController as WebCategoryController;
use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\Web\NewPasswordController;
use App\Http\Controllers\Web\PasswordResetLinkController;
use App\Http\Controllers\Web\ProductController as WebProductController;
use App\Http\Controllers\Web\RegisteredCustomerController;
use App\Http\Controllers\Web\WebController;
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
    Route::post('/products/supplier/{id}', [ProductController::class, 'getProductsBySupplierId'])->name('products.get-products-by-supplier-id');
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

require __DIR__.'/auth.php';

Route::name('web.')->group(function () {
    Route::get('/', [WebController::class, 'index'])->name('home');
    Route::get('/category', function () {
        return view('web.page.category');
    });
    Route::get('/product-detail', function () {
        return view('web.page.product-detail');
    });

    Route::get('dang-ky', [RegisteredCustomerController::class, 'create'])
        ->name('register');

    Route::post('dang-ky', [RegisteredCustomerController::class, 'store']);

    Route::get('dang-nhap', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('dang-nhap', [AuthenticatedSessionController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/doi-mat-khau', [CustomerController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password', [CustomerController::class, 'updatePassword'])->name('update-password');
    Route::get('/thong-tin-ca-nhan', [CustomerController::class, 'profile'])->name('profile');
    Route::get('/lich-su-mua-hang', [CustomerController::class, 'purchaseHistory'])->name('purchase-history');
    Route::get('/chi-tiet-don-hang/{order}', [CustomerController::class, 'orderDetail'])->name('order-detail');

    Route::get('/san-pham/{category}/{product}', [WebProductController::class, 'detail'])->name('product-detail');
    Route::post('/products/get-variants-by-color-code', [WebProductController::class, 'getVariantsByColorCode'])->name('get-variants-by-color-code');

    Route::get('/danh-muc/{category}', [WebCategoryController::class, 'detail'])->name('category');

    Route::get('quen-mat-khau', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('quen-mat-khau', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    Route::get('tim-kiem', [WebController::class, 'search'])->name('search');
    Route::get('chinh-sach-bao-mat', [WebController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('chinh-sach-mua-hang', [WebController::class, 'purchasePolicy'])->name('purchase-policy');
    Route::post('them-vao-gio', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::get('gio-hang', [CartController::class, 'cart'])->name('cart');
    Route::post('cap-nhat-gio-hang', [CartController::class, 'updateCart'])->name('update-cart');
    Route::post('xoa-san-pham-gio-hang/{rowId}', [CartController::class, 'deleteItemCart'])->name('delete-item-cart');
    Route::get('thanh-toan', [CartController::class, 'viewCheckout'])->name('view-checkout');
    Route::post('thanh-toan', [CartController::class, 'checkout'])->name('checkout');
    Route::get('thanh-toan-thanh-cong', [CartController::class, 'paymentSuccess'])->name('payment-success');
    Route::post('generate-chat-ai', [WebController::class, 'generateChatAI'])->name('generate-chat-ai');
});

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
