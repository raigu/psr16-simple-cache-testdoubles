<?php

namespace Raigu\TestDouble\Psr16;

/**
 * @covers
 */
final class DisconnectedCacheStubTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function get_returns_default_value()
    {
        $sut = new DisconnectedCacheStub;
        $default = 'b';
        $this->assertEquals(
            $default,
            $sut->get('1', $default)
        );
    }

    /**
     * @test
     */
    public function set_returns_False()
    {
        $sut = new DisconnectedCacheStub;
        $this->assertFalse(
            $sut->set('1', 'a')
        );
    }

    /**
     * @test
     */
    public function delete_returns_False()
    {
        $sut = new DisconnectedCacheStub;
        $this->assertFalse(
            $sut->delete('1')
        );
    }

    /**
     * @test
     */
    public function clear_returns_False()
    {
        $sut = new DisconnectedCacheStub;
        $this->assertFalse(
            $sut->clear()
        );
    }

    /**
     * @test
     */
    public function getMultiple_returns_default_value()
    {
        $sut = new DisconnectedCacheStub;
        $default = 'default-stub';
        $this->assertEquals(
            ['1' => $default, '2' => $default],
            $sut->getMultiple(['1', '2'], $default)
        );
    }

    /**
     * @test
     */
    public function setMultiple_returns_False()
    {
        $sut = new DisconnectedCacheStub;
        $this->assertFalse(
            $sut->setMultiple(['1' => 'a'])
        );
    }

    /**
     * @test
     */
    public function deleteMultiple_returns_False()
    {
        $sut = new DisconnectedCacheStub;
        $this->assertFalse(
            $sut->deleteMultiple([])
        );
    }

    /**
     * @test
     */
    public function has_returns_False()
    {
        $sut = new DisconnectedCacheStub;
        $this->assertFalse(
            $sut->has('1')
        );
    }
}