<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\Identity\RegisterUser\RegisterUserCommand;
use App\Application\Identity\RegisterUser\RegisterUserHandler;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\RegisterUserResource;
use Illuminate\Http\JsonResponse;

final class RegisterUserController
{
    public function __invoke(RegisterUserRequest $request, RegisterUserHandler $handler): JsonResponse
    {
        $command = new RegisterUserCommand(
            email: $request->validated('email'),
            name: $request->validated('name'),
        );

        $id = $handler->handle($command);

        return (new RegisterUserResource($id))
            ->response()
            ->setStatusCode(201);
    }
}
