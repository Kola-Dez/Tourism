<?php

use App\Http\Controllers\api\V1\Blog\BlogController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'blogs',  'middleware' => 'api'], function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::get('/{blog}', [BlogController::class, 'show']);
});
