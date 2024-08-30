<?php

use App\Http\Controllers\api\V1\Destination\DestinationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'destinations', 'middleware' => 'api'], function () {
    Route::get('/', [DestinationController::class, 'index']);
    Route::get('/{destination}', [DestinationController::class, 'show']);
    Route::get('/travel/{destination}', [DestinationController::class, 'travelDestinations']);
    Route::get('/groupTours/{destination}', [DestinationController::class, 'groupTours']);
    Route::get('/privateTours/{destination}', [DestinationController::class, 'privateTours']);
    Route::get('/popular/{destination}', [DestinationController::class, 'popularTours']);
    Route::get('/transport/{destination}', [DestinationController::class, 'transportShow']);

});
