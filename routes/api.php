<?php

use Illuminate\Support\Facades\Route;

use App\UI\Http\Controllers\Identity\{
    RegisterUserController,
    LoginUserController
};

Route::post('/users', RegisterUserController::class);
Route::post('/login', LoginUserController::class);
