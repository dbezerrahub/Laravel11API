<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require base_path('routes/interfaces/userInterface.php');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

#include_once 'interfaces/user.php';
