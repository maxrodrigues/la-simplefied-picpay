<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\{JsonResponse, Response};
use Illuminate\Support\Facades\Route;

Route::get('health', function () {
    return new JsonResponse('healthy', Response::HTTP_OK);
});

Route::post('register', RegisterController::class);
