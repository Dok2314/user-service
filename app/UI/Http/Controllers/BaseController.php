<?php

declare(strict_types=1);

namespace App\UI\Http\Controllers;

use App\Application\Shared\Bus\Command\CommandBus;
use Illuminate\Routing\Controller as LaravelController;

abstract class BaseController extends LaravelController
{
    public function __construct(protected CommandBus $commandBus)
    {
    }
}
