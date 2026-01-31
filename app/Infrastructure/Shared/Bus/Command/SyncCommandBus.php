<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Bus\Command;

use App\Application\Shared\Bus\Command\{
    Command,
    CommandBus,
    HandlerResolver
};
use RuntimeException;

final readonly class SyncCommandBus implements CommandBus
{
    public function __construct(
        private HandlerResolver $resolver,
    ) {}

    public function dispatch(Command $command): mixed
    {
        $handler = $this->resolver->resolve($command);

        if (!method_exists($handler, 'handle')) {
            throw new RuntimeException('Handler must have method handle()');
        }

        return $handler->handle($command);
    }
}
