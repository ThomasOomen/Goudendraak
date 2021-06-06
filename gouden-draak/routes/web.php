<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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

Route::get('/', [HomeController::class, 'showHomePage']);

Route::middleware('can:admin-role')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::get('/dashboard/product-create', [DashboardController::class, 'product_create']);
    Route::post('/dashboard/product-store', [DashboardController::class, 'product_store']);
    Route::get('/dashboard/product-edit/{id}', [DashboardController::class, 'product_edit']);
    Route::post('/dashboard/product-update', [DashboardController::class, 'product_update']);
    Route::get('/dashboard/product-delete/{id}', [DashboardController::class, 'product_destroy']);
});

Route::middleware('can:kassa-role')->group(function () {
    Route::get('/order-index', [OrderController::class, 'order_index']);
});

Route::get('/menu-card', [HomeController::class, 'showMenuCard']);
Route::get('/make-menu-pdf', [HomeController::class, 'makeMenuPDF']);

Route::get('/news', [HomeController::class, 'showNews']);
Route::get('/contact', [HomeController::class, 'showContact']);

Route::get('/order', [OrderController::class, 'order_create']);
Route::post('/order-store', [OrderController::class, 'order_store']);

require __DIR__.'/auth.php';
