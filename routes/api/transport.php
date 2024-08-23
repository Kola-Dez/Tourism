<?php

use App\Http\Controllers\api\V1\Transport\TransportController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'transports', 'middleware' => 'api'], function () {
    Route::get('/', [TransportController::class, 'index']);
    Route::get('/{transport}', [TransportController::class, 'show']);
});
