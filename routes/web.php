<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
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

// Auth
Route::prefix('auth')->controller(AuthenticatedSessionController::class)->group(function () {
    Route::prefix('login')->middleware('guest')->group(function () {
        Route::get('/', 'create')->name('login');
        Route::post('/', 'store');
    });
});

// Backend
Route::prefix('cms-admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {
    // Authentication
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::get('profile', [UserController::class, 'index'])->name('profile');
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });


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

        // Delete
        Route::post('delete/{id}', 'delete')->name('delete');
    });

    // Brand
    Route::prefix('brand')->controller(BrandController::class)->name('brand.')->group(function () {
        // List
        Route::get('/', 'index')->name('index');
        Route::get('getList', 'getList')->name('getList');

        // Create
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');

        // Update
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');

        // Delete
        Route::post('delete/{id}', 'delete')->name('delete');
    });
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//require __DIR__.'/auth.php';
