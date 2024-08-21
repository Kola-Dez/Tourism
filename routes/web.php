<?php

use Illuminate\Support\Facades\Route;

include_once 'admin.php';

Route::get('/', function () {
    return view('welcome');
});
