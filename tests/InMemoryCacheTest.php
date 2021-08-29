<?php

namespace Raigu\TestDouble\Psr16;

/**
 * @covers \Raigu\TestDouble\Psr16\InMemoryCache
 * @uses \Raigu\TestDouble\Psr16\ClockInterface
 * @uses \Raigu\TestDouble\Psr16\PhpNativeClock
 */
final class InMemoryCacheTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function fetches_previously_stored_value()
    {
        $sut = new InMemoryCache;
        $sut->set($key = '123', $value = 'abc');

        $this->assertEquals(
            $value,
            $sut->get($key)
        );
    }

    /**
     * @test
     */
    public function returns_default_if_no_hit()
    {
        $sut = new InMemoryCache;
        $default = 'whatever';
        $this->assertEquals(
            $default,
            $sut->get('random', $default)
        );
    }

    /**
     * @test
     */
    public function knows_what_keys_have_value()
    {
        $sut = new InMemoryCache;
        $key = '123';
        $this->assertFalse($sut->has($key));
        $sut->set($key, $value = 'abc');
        $this->assertTrue($sut->has($key));
    }

    /**
     * @test
     */
    public function deletes_stored_value()
    {
        $sut = new InMemoryCache;
        $sut->set($key = '123', 'abc');
        $ret = $sut->delete($key);
        $this->assertFalse($sut->has($key));
        $this->assertTrue($ret, 'Returns True if the item was successfully removed.');
    }

    /**
     * @test
     */
    public function deleting_un_existing_item_is_considered_successful()
    {
        $sut = new InMemoryCache;
        $this->assertTrue($sut->delete('not-existing'));
    }

    /**
     * @test
     */
    public function clears_all_cache()
    {
        $sut = new InMemoryCache;
        $sut->set($key = '123', 'abc');
        $sut->clear();
        $this->assertFalse($sut->has($key));
    }

    /**
     * @test
     */
    public function fetches_multiple_items()
    {
        $sut = new InMemoryCache;
        $sut->set($key1 = '1', $value1 = 'a');
        $sut->set($key2 = '2', $value2 = 'b');
        $this->assertEquals(
            [$key1 => $value1, $key2 => $value2],
            $sut->getMultiple([$key1, $key2])
        );
    }

    /**
     * @test
     */
    public function returns_default_if_item_not_found_when_asking_multiple_items()
    {
        $sut = new InMemoryCache;
        $key = '1';
        $default = 'a';
        $this->assertEquals(
            [$key => $default],
            $sut->getMultiple([$key], $default)
        );
    }

    /**
     * @test
     */
    public function sets_multiple_items()
    {
        $sut = new InMemoryCache;
        $key1 = '1';
        $value1 = 'a';
        $key2 = '2';
        $value2 = 'b';
        $sut->setMultiple([$key1 => $value1, $key2 => $value2]);

        $this->assertEquals($value1, $sut->get($key1));
        $this->assertEquals($value2, $sut->get($key2));
    }

    /**
     * @test
     */
    public function set_multiple_items_returns_True_on_success()
    {
        $sut = new InMemoryCache;
        $this->assertTrue($sut->setMultiple([]));
    }

    /**
     * @test
     */
    public function deletes_multiple_items()
    {
        $sut = new InMemoryCache;
        $sut->set($key1 = '1', 'b');
        $sut->set($key2 = '2', 'c');

        $sut->deleteMultiple([$key1, $key2]);

        $this->assertFalse($sut->has($key1));
        $this->assertFalse($sut->has($key2));
    }

    /**
     * @test
     */
    public function deleting_multiple_items_returns_True_on_success()
    {
        $sut = new InMemoryCache;
        $this->assertTrue($sut->deleteMultiple([]));
    }
}