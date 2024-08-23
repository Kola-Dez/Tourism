<?php

use App\Http\Controllers\api\V1\FindAdventure\FindAdventureController;
use Illuminate\Support\Facades\Route;

Route::post('/findAdventure', [FindAdventureController::class, 'findAdventure']);
