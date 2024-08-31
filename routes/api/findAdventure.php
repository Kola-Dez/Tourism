<?php

use App\Http\Controllers\api\V1\FindAdventure\FindAdventureController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'findAdventure', 'middleware' => 'api'], function () {
    Route::post('/', [FindAdventureController::class, 'findAdventure']);
});
