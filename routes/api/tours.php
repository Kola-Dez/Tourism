<?php

use App\Http\Controllers\api\V1\Tours\GroupTourController;
use App\Http\Controllers\api\V1\Tours\PrivateTourController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'group-tours', 'middleware' => 'api'], function () {
    Route::get('/', [GroupTourController::class, 'index']);
    Route::get('/{groupTour}', [GroupTourController::class, 'show']);
});


Route::group(['prefix' => 'private-tours', 'middleware' => 'api'], function () {
    Route::get('/', [PrivateTourController::class, 'index']);
    Route::get('/{privateTour}', [PrivateTourController::class, 'show']);
});
