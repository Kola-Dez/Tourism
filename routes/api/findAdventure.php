<?php

use App\Http\Controllers\api\V1\FindAdventure\FindAdventureController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'findAdventures', 'middleware' => 'api'], function () {
    Route::post('/', [FindAdventureController::class, 'findAdventure']);
});
