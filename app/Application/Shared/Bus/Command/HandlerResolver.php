<?php

declare(strict_types=1);

namespace App\Application\Shared\Bus\Command;

interface HandlerResolver
{
    /** @return object handler instance */
    public function resolve(Command $command): object;
}
