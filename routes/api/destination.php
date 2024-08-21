<?php

use App\Http\Controllers\api\V1\Destination\DestinationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'destination', 'middleware' => 'api'], function () {
    Route::get('/', [DestinationController::class, 'index']);
    Route::get('/{slug}', [DestinationController::class, 'show']);
});
