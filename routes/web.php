<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\Tours\Tours\AdminGroupTourController;
use App\Http\Middleware\AdminAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::middleware(AdminAuthMiddleware::class)->group(function (){
        Route::get('/', [AdminController::class, 'index'])->name('index');


//         Групповые туры
        Route::prefix('group_tours')->name('group_tours.')->group(function () {
            Route::get('/', [AdminGroupTourController::class, 'index'])->name('index');
            Route::get('/create', [AdminGroupTourController::class, 'create'])->name('create');
            Route::post('/', [AdminGroupTourController::class, 'store'])->name('store');
            Route::get('/{groupTour}', [AdminGroupTourController::class, 'show'])->name('show');
            Route::get('/{groupTour}/edit', [AdminGroupTourController::class, 'edit'])->name('edit');
            Route::patch('/{groupTour}', [AdminGroupTourController::class, 'update'])->name('update');
            Route::delete('/{groupTour}', [AdminGroupTourController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::get('/', function () {
    return view('welcome');
});
