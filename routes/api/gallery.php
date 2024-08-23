<?php

use App\Http\Controllers\api\V1\Gallery\GalleryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'galleries', 'middleware' => 'api'], function () {
    Route::get('/', [GalleryController::class, 'index']);
});
