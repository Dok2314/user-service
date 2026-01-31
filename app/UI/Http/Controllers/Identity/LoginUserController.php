<?php

namespace App\UI\Http\Controllers\Identity;

use App\Application\Identity\Command\LoginUser\LoginUserCommand;
use App\UI\Http\Controllers\BaseController;
use App\UI\Http\Requests\LoginUserRequest;
use App\UI\Http\Resources\LoginUserResource;

final class LoginUserController extends BaseController
{
    public function __invoke(LoginUserRequest $request)
    {
        $token = $this->commandBus->dispatch(
            new LoginUserCommand(
                email: $request->email,
                password: $request->password,
            )
        );

        return new LoginUserResource(['token' => $token]);
    }
}
