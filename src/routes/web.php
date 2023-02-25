<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('/unit', UnitController::class)->middleware('can:manage-unit');
    Route::resource('/payment-method', PaymentMethodController::class)->middleware('can:manage-payment-method');
    Route::resource('/user', UserController::class);

    Route::resource('/supplier', SupplierController::class)->middleware('can:manage-supplier');

    Route::group(['middleware' => 'can:manage-permission'], function () {
        Route::get('/role', [RoleController::class, 'index'])->name('role.index');
        Route::post('/role', [RoleController::class, 'store'])->name('role.store');
        Route::put('/role/{role}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('/role/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
        Route::get('/api/role/permission/{id?}', [RoleController::class, 'permission'])->name('role.permission');

        Route::resource('/permission', PermissionController::class);
    });

    Route::get('/sales', function () {})->name('sales.index');
    Route::get('/purchase', function () {})->name('purchase.index');
    Route::get('/product', function () {})->name('product.index');
    Route::get('/stock', function () {})->name('stock.index');
    Route::get('/adjustment', function () {})->name('adjustment.index');
});

Route::get('/test', function () {
    return view('dashboard.index');
});

require __DIR__ . '/auth.php';
