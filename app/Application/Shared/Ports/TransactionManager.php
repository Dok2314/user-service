<?php

declare(strict_types=1);

namespace App\Application\Shared\Ports;

interface TransactionManager
{
    /**
     * @template TReturn
     * @param callable(): TReturn $callback
     * @return TReturn
     */
    public function run(callable $callback);
}
