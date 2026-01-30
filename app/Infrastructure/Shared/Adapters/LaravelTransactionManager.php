<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Adapters;

use App\Application\Shared\Ports\TransactionManager;
use Illuminate\Support\Facades\DB;
use Throwable;

final class LaravelTransactionManager implements TransactionManager
{
    /**
     * @throws Throwable
     */
    public function run(callable $callback)
    {
        return DB::transaction($callback);
    }
}
