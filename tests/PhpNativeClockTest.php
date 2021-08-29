<?php

namespace Raigu\TestDouble\Psr16;

/**
 * @covers \Raigu\TestDouble\Psr16\PhpNativeClock
 */
final class PhpNativeClockTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function returns_current_system_date_and_time()
    {
        $sut = new PhpNativeClock;
        $before = new \DateTimeImmutable;
        $current = $sut->now();
        $after = new \DateTimeImmutable;

        $this->assertLessThanOrEqual($before->getTimestamp(), $current->getTimestamp());
        $this->assertGreaterThanOrEqual($after->getTimestamp(), $current->getTimestamp());
    }
}