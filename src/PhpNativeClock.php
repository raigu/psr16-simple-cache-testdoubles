<?php

namespace Raigu\TestDouble\Psr16;

final class PhpNativeClock implements ClockInterface
{
    public function now(): \DateTimeImmutable
    {
        return new \DateTimeImmutable;
    }
}