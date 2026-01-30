<?php

use App\UI\Http\Controllers\Identity\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::post('/users', RegisterUserController::class);
