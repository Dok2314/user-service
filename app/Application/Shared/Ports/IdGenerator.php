<?php

namespace App\Application\Shared\Ports;

interface IdGenerator
{
    public function next(): string;
}
