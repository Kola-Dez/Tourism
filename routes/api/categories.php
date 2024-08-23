<?php

use App\Http\Controllers\api\V1\Category\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'categories', 'middleware' => 'api'], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{category}', [CategoryController::class, 'show']);
    Route::get('/tours/{category}', [CategoryController::class, 'getTours']);
});
