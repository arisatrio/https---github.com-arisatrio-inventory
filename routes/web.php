<?php

use App\Http\Controllers\Admin\Gudang\ProdukController;
use App\Http\Controllers\Admin\Gudang\StokProdukController;
use App\Http\Controllers\Admin\Gudang\TipeProdukController;
use App\Http\Controllers\Laporan\OrderReportController;
use App\Http\Controllers\Laporan\StokReportController;
use App\Http\Controllers\PO\CancelOrderController;
use App\Http\Controllers\PO\DeliveryOrderController;
use App\Http\Controllers\PO\DeliveryOrderPrintController;
use App\Http\Controllers\PO\OrderController;
use App\Http\Controllers\PO\OrderPrintController;
use App\Http\Controllers\PO\OrderProductController;
use App\Http\Controllers\PO\SendToLogistikController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('profile')->as('profile.')->group(function () {
        Route::get('edit', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('edit');
        Route::put('update', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('update');
        Route::put('update-password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('update-password');
        Route::post('update-photo', [App\Http\Controllers\Admin\ProfileController::class, 'updatePhoto'])->name('update-photo');
    });

    Route::prefix('laporan')->as('laporan.')->group(function () {
        Route::get('/order', OrderReportController::class)->name('order');
        Route::get('/stok', StokReportController::class)->name('stok');
    });

    Route::prefix('po')->as('po.')->group(function () {
        Route::resource('order', OrderController::class);
        Route::resource('order-produk', OrderProductController::class);
        Route::get('/order/print/{id}', OrderPrintController::class)->name('order.print');
        Route::get('/order/send-to-logistik/{id}', SendToLogistikController::class)->name('order.send-to-logistik');
        Route::get('/order/cancel-order/{id}', CancelOrderController::class)->name('order.cancel');
        Route::get('/order/delivery-order/{id}', DeliveryOrderController::class)->name('order.delivery');
        Route::get('/order/print/delivery-order/{id}', DeliveryOrderPrintController::class)->name('order.print-delivery');
    });

    Route::prefix('gudang')->as('gudang.')->group(function () {
        Route::resource('produk', ProdukController::class)->except('create', 'show', 'update');
        Route::resource('tipe-produk', TipeProdukController::class)->except('create', 'show', 'update');
        Route::resource('stok-produk', StokProdukController::class)->except('create', 'show', 'update');
    });

    Route::prefix('user-management')->as('user-management.')->group(function () {
        Route::resource('role', App\Http\Controllers\Admin\Authorization\RoleController::class)->except('update', 'create');
        Route::get('role-restore/{id}', [App\Http\Controllers\Admin\Authorization\RoleController::class, 'restore'])->name('role.restore');
        Route::resource('department', App\Http\Controllers\Admin\UserManagement\DepartmentController::class)->except('show', 'update', 'create');
        Route::get('department-restore/{id}', [App\Http\Controllers\Admin\UserManagement\DepartmentController::class, 'restore'])->name('department.restore');
        Route::resource('users',  App\Http\Controllers\Admin\UserManagement\UserController::class)->except('show', 'update', 'create');
        Route::get('users-restore/{id}', [App\Http\Controllers\Admin\UserManagement\UserController::class, 'restore'])->name('users.restore');
        Route::post('users-import', [App\Http\Controllers\Admin\UserManagement\UserController::class, 'import'])->name('users.import');
    });
});
