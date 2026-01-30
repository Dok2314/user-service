<?php

declare(strict_types=1);

namespace App\Application\Shared\Bus\Command;

interface CommandBus
{
    public function dispatch(Command $command): mixed;
}
