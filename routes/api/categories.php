<?php

use App\Http\Controllers\api\V1\Category\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'categories', 'middleware' => 'api'], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{slug}', [CategoryController::class, 'show']);
    Route::get('/popular', [CategoryController::class, 'mostPopularTours']);
});
