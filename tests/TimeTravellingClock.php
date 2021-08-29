<?php

namespace Raigu\TestDouble\Psr16;

use DateTimeImmutable;

/**
 * I am a clock which can travel in time.
 */
final class TimeTravellingClock implements ClockInterface
{
    private DateTimeImmutable $now;

    public function now(): DateTimeImmutable
    {
        return $this->now;
    }

    public function travelToFuture(\DateInterval $interval)
    {
        $this->now = $this->now->add($interval);
    }

    public function __construct()
    {
        $this->now = new DateTimeImmutable();
    }
}