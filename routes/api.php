<?php

use Illuminate\Support\Facades\Route;

use App\UI\Http\Controllers\Identity\{
    RegisterUserController,
    LoginUserController
};

use App\UI\Http\Controllers\Authorization\{
    RoleController,
};

Route::post('/users', RegisterUserController::class);
Route::post('/login', LoginUserController::class);

Route::prefix('authorization')
    ->middleware('auth:sanctum')
    ->group(function () {

        Route::group(['prefix' => 'roles'], function () {
            Route::post('/', [RoleController::class, 'store']);
            Route::get('/',  [RoleController::class, 'index']); // optional
            Route::get('/{roleId}', [RoleController::class, 'show']); // optional
        });
    });
