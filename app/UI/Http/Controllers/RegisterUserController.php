<?php

declare(strict_types=1);

namespace App\UI\Http\Controllers;

use App\Application\Identity\Command\RegisterUser\RegisterUserCommand;
use App\Application\Identity\Command\RegisterUser\RegisterUserHandler;
use App\UI\Http\Requests\RegisterUserRequest;
use App\UI\Http\Resources\RegisterUserResource;
use Illuminate\Http\JsonResponse;
use Throwable;

final class RegisterUserController
{
    /**
     * @throws Throwable
     */
    public function __invoke(RegisterUserRequest $request, RegisterUserHandler $handler): JsonResponse
    {
        $command = new RegisterUserCommand(
            email: $request->validated('email'),
            name: $request->validated('name'),
            password: $request->validated('password')
        );

        $id = $handler->handle($command);

        return (new RegisterUserResource($id))
            ->response()
            ->setStatusCode(201);
    }
}
