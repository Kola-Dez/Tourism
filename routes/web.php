<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Middleware\AdminAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::middleware(AdminAuthMiddleware::class)->group(function (){
        Route::get('/', [AdminController::class, 'index'])->name('index');


        // Групповые туры
//        Route::prefix('tours')->name('tours.')->group(function () {
//            Route::get('/', [AdminTourController::class, 'index'])->name('index');
//            Route::get('/{id}', [AdminTourController::class, 'show'])->name('show');
//            Route::post('/', [AdminTourController::class, 'store'])->name('store');
//            Route::post('/{id}', [AdminTourController::class, 'update'])->name('update'); // TODO: Patch
//            Route::delete('/{id}', [AdminTourController::class, 'destroy'])->name('destroy');
//        });
    });
});
