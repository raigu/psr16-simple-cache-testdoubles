<?php

namespace Raigu\TestDouble\Psr16;

/**
 * Same as PSR-20. Will mimic it until PSR-20 gets official.
 */
interface ClockInterface
{
    /**
     * Returns the current time as a DateTimeImmutable Object
     */
    public function now(): \DateTimeImmutable;

}