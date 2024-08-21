<?php

use App\Http\Controllers\api\V1\Blog\BlogController;
use App\Http\Controllers\api\V1\Category\CategoryController;
use App\Http\Controllers\api\V1\City\CityController;
use App\Http\Controllers\api\V1\Country\CountryController;
use App\Http\Controllers\api\V1\Tag\TagController;
use App\Http\Controllers\api\V1\Tours\PrivateTourController;
use Illuminate\Support\Facades\Route;

// Категории
Route::group(['prefix' => 'categories', 'middleware' => 'api'], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/popular', [CategoryController::class, 'mostPopularTours']);
    Route::get('/{slug}', [CategoryController::class, 'show']);
});

// Групповые туры
Route::group(['prefix' => 'group-tours', 'middleware' => 'api'], function () {
    Route::get('/', [PrivateTourController::class, 'index']);
    Route::get('/{id}', [PrivateTourController::class, 'show']);
});

// Private Tours
Route::group(['prefix' => 'private-tours', 'middleware' => 'api'], function () {
    Route::get('/', [PrivateTourController::class, 'index']);
    Route::get('/{id}', [PrivateTourController::class, 'show']);
    Route::post('/', [PrivateTourController::class, 'store']);
    Route::post('/{id}', [PrivateTourController::class, 'update']);
    Route::delete('/{id}', [PrivateTourController::class, 'destroy']);
});

// Blogs
Route::group(['prefix' => 'blogs', 'middleware' => 'api'], function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::get('/{id}', [BlogController::class, 'show']);
    Route::post('/', [BlogController::class, 'store']);
    Route::post('/{id}', [BlogController::class, 'update']);
    Route::delete('/{id}', [BlogController::class, 'destroy']);
});


// Countries
Route::group(['prefix' => 'countries', 'middleware' => 'api'], function () {
    Route::get('/', [CountryController::class, 'index']);
    Route::get('/{slug}', [CountryController::class, 'show']);
});

// Cities
Route::group(['prefix' => 'cities', 'middleware' => 'api'], function () {
    Route::get('/', [CityController::class, 'index']);
    Route::get('/{id}', [CityController::class, 'show']);
    Route::post('/', [CityController::class, 'store']);
    Route::post('/{id}', [CityController::class, 'update']);
    Route::delete('/{id}', [CityController::class, 'destroy']);
});

// Tags
Route::get('tags', [TagController::class, 'index']);
Route::get('tags/{id}', [TagController::class, 'show']);
Route::post('tags', [TagController::class, 'store']);
Route::post('tags/{id}', [TagController::class, 'update']);
Route::delete('tags/{id}', [TagController::class, 'destroy']);

