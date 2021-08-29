<?php

namespace Raigu\TestDouble\Psr16;

use Psr\SimpleCache\CacheInterface;

/**
 * I am a cache which is not operational.
 *
 * I simulate a cache over network that has been disconnected.
 */
final class DisconnectedCacheStub implements CacheInterface
{
    public function get($key, $default = null)
    {
        return $default;
    }

    public function set($key, $value, $ttl = null)
    {
        return false;
    }

    public function delete($key)
    {
        return false;
    }

    public function clear()
    {
        return false;
    }

    public function getMultiple($keys, $default = null)
    {
        $ret = [];
        foreach ($keys as $key) {
            $ret[$key] = $default;
        }

        return $ret;
    }

    public function setMultiple($values, $ttl = null)
    {
        return false;
    }

    public function deleteMultiple($keys)
    {
        return false;
    }

    public function has($key)
    {
        return false;
    }
}