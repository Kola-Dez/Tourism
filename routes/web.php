<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\blog\AdminBlogController;
use App\Http\Controllers\admin\Category\AdminCategoryController;
use App\Http\Controllers\admin\Tours\AdminGroupTourController;
use App\Http\Controllers\admin\Tours\AdminPrivateTourController;
use App\Http\Middleware\AdminAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::middleware(AdminAuthMiddleware::class)->group(function (){
        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::prefix('group_tours')->name('group_tours.')->group(function () {
            Route::get('/', [AdminGroupTourController::class, 'index'])->name('index');
            Route::get('/create', [AdminGroupTourController::class, 'create'])->name('create');
            Route::post('/', [AdminGroupTourController::class, 'store'])->name('store');
            Route::get('/{groupTour}', [AdminGroupTourController::class, 'show'])->name('show');
            Route::get('/{groupTour}/edit', [AdminGroupTourController::class, 'edit'])->name('edit');
            Route::patch('/{groupTour}', [AdminGroupTourController::class, 'update'])->name('update');
            Route::delete('/{groupTour}', [AdminGroupTourController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('private_tours')->name('private_tours.')->group(function () {
            Route::get('/', [AdminPrivateTourController::class, 'index'])->name('index');
            Route::get('/create', [AdminPrivateTourController::class, 'create'])->name('create');
            Route::post('/', [AdminPrivateTourController::class, 'store'])->name('store');
            Route::get('/{privateTour}', [AdminPrivateTourController::class, 'show'])->name('show');
            Route::get('/{privateTour}/edit', [AdminPrivateTourController::class, 'edit'])->name('edit');
            Route::patch('/{privateTour}', [AdminPrivateTourController::class, 'update'])->name('update');
            Route::delete('/{privateTour}', [AdminPrivateTourController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
            Route::get('/create', [AdminCategoryController::class, 'create'])->name('create');
            Route::post('/', [AdminCategoryController::class, 'store'])->name('store');
            Route::get('/{category}', [AdminCategoryController::class, 'show'])->name('show');
            Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('edit');
            Route::patch('/{category}', [AdminCategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('blogs')->name('blogs.')->group(function () {
            Route::get('/', [AdminBlogController::class, 'index'])->name('index');
            Route::get('/create', [AdminBlogController::class, 'create'])->name('create');
            Route::post('/', [AdminBlogController::class, 'store'])->name('store');
            Route::get('/{blog}', [AdminBlogController::class, 'show'])->name('show');
            Route::get('/{blog}/edit', [AdminBlogController::class, 'edit'])->name('edit');
            Route::patch('/{blog}', [AdminBlogController::class, 'update'])->name('update');
            Route::delete('/{blog}', [AdminBlogController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::get('/', function () {
    return view('welcome');
});
