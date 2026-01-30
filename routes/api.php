<?php

use App\UI\Http\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::post('/users', RegisterUserController::class);
