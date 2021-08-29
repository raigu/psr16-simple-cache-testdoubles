<?php

namespace Raigu\TestDouble\Psr16;


use DateInterval;

/**
 * @covers \Raigu\TestDouble\Psr16\InMemoryCache
 */
final class InMemoryCacheTimeToLiveTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function can_set_ttl_as_seconds()
    {
        $clock = new TimeTravellingClock;
        $sut = new InMemoryCache($clock);
        $sut->set($key = '123', 'a', $ttl = 1);

        $this->assertTrue($sut->has($key));
        $clock->travelToFuture(new DateInterval('PT1S'));
        $this->assertFalse($sut->has($key));
    }

    /**
     * @test
     */
    public function can_set_ttl_as_DateInterval()
    {
        $clock = new TimeTravellingClock;
        $sut = new InMemoryCache($clock);
        $sut->set($key = '123', 'a', new DateInterval('PT1S'));

        $this->assertTrue($sut->has($key));
        $clock->travelToFuture(new DateInterval('PT1S'));
        $this->assertFalse($sut->has($key));
    }

    /**
     * @test
     */
    public function expired_elements_are_deleted()
    {
        $clock = new TimeTravellingClock;
        $sut = new InMemoryCache($clock);
        $sut->set($key = '123', 'a', $ttl = 1);

        $this->assertNotNull($sut->get($key));
        $clock->travelToFuture(new DateInterval('PT1S'));
        $this->assertNull($sut->get($key));
    }

    /**
     * @test
     */
    public function can_set_ttl_on_multiple()
    {
        $clock = new TimeTravellingClock;
        $sut = new InMemoryCache($clock);
        $key = '123';
        $sut->setMultiple([$key => 'a'], $ttl = 1);

        $this->assertTrue($sut->has($key));
        $clock->travelToFuture(new DateInterval('PT1S'));
        $this->assertFalse($sut->has($key));
    }
}