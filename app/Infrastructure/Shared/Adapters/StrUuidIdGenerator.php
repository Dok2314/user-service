<?php

namespace App\Infrastructure\Shared\Adapters;

use App\Application\Shared\Ports\IdGenerator;
use Illuminate\Support\Str;

final class StrUuidIdGenerator implements IdGenerator
{
    public function next(): string
    {
        return (string) Str::uuid();
    }
}
