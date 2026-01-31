<?php

declare(strict_types=1);

namespace App\UI\Http\Controllers\Identity;

use App\Application\Identity\Command\RegisterUser\RegisterUserCommand;
use App\UI\Http\Controllers\BaseController;
use App\UI\Http\Requests\Identity\RegisterUserRequest;
use App\UI\Http\Resources\Identity\RegisterUserResource;
use Illuminate\Http\JsonResponse;
use Throwable;

final class RegisterUserController extends BaseController
{
    /**
     * @throws Throwable
     */
    public function __invoke(RegisterUserRequest $request): JsonResponse
    {
        $id = $this->commandBus->dispatch(new RegisterUserCommand(
            email: $request->validated('email'),
            name: $request->validated('name'),
            password: $request->validated('password')
        ));

        return (new RegisterUserResource($id))->response()->setStatusCode(201);
    }
}
