<?php

use App\Http\Controllers\api\V1\Tours\GroupTourController;
use App\Http\Controllers\api\V1\Tours\PrivateTourController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'group-tours', 'middleware' => 'api'], function () {
    Route::get('/{id}', [GroupTourController::class, 'show']);
});


Route::group(['prefix' => 'private-tours', 'middleware' => 'api'], function () {
    Route::get('/{id}', [PrivateTourController::class, 'show']);
});
