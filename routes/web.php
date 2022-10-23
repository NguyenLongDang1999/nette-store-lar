<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
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

// Backend
Route::prefix('cms-admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Category
    Route::prefix('category')->controller(CategoryController::class)->name('category.')->group(function () {
        // List
        Route::get('/', 'index')->name('index');
        Route::get('getList', 'getList')->name('getList');

        // Create
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');

        // Update
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');

        // Recycle
        Route::get('recycle', 'recycle')->name('recycle');
        Route::get('getListRecycle', 'getListRecycle')->name('getListRecycle');
    });
});
