<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
Route::get('/dashboard/product-create', [DashboardController::class, 'product_create'])
    ->middleware(['auth']);
Route::post('/dashboard/product-store', [DashboardController::class, 'product_store'])
    ->middleware(['auth']);
Route::get('/dashboard/product-edit/{id}', [DashboardController::class, 'product_edit'])
    ->middleware(['auth']);
Route::post('/dashboard/product-update', [DashboardController::class, 'product_update'])
    ->middleware(['auth']);
Route::get('/dashboard/product-delete/{id}', [DashboardController::class, 'product_destroy'])
    ->middleware(['auth']);

Route::get('/menu-card', [HomeController::class, 'show']);

require __DIR__.'/auth.php';
