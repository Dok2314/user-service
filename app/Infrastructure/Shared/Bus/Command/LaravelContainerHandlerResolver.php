<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Bus\Command;

use App\Application\Shared\Bus\Command\{
    Command,
    HandlerResolver
};
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use RuntimeException;

final readonly class LaravelContainerHandlerResolver implements HandlerResolver
{
    public function __construct(private Container $container) {}

    /**
     * @throws BindingResolutionException
     */
    public function resolve(Command $command): object
    {
        $commandClass = $command::class;

        if (!str_ends_with($commandClass, 'Command')) {
            throw new RuntimeException("Command class must end with 'Command': {$commandClass}");
        }

        $handlerClass = substr($commandClass, 0, -strlen('Command')) . 'Handler';

        if (!class_exists($handlerClass)) {
            throw new RuntimeException("Handler not found for command {$commandClass}. Expected: {$handlerClass}");
        }

        return $this->container->make($handlerClass);
    }
}
