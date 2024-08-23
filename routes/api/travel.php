<?php

use App\Http\Controllers\api\V1\TravelDestination\TravelDestinationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'travel', 'middleware' => 'api'], function () {
    Route::get('/', [TravelDestinationController::class, 'index']);
    Route::get('/{travelDestination}', [TravelDestinationController::class, 'show']);
});
