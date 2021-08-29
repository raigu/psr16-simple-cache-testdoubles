<?php

namespace Raigu\TestDouble\Psr16;

use Psr\SimpleCache\CacheInterface;

final class InMemoryCache implements CacheInterface
{

    private array $values;

    public function __construct()
    {
        $this->values = [];
    }

    public function get($key, $default = null)
    {
        $item = $this->values[$key] ?? [$default, null];

        return $item[0];
    }

    public function set($key, $value, $ttl = null)
    {
        $this->values[$key] = [$value, $ttl];
    }

    /**
     * Delete an item from the cache by its unique key.
     *
     * @param string $key The unique cache key of the item to delete.
     *
     * @return bool True if the item was successfully removed. False if there was an error.
     *              This component never returns False.
     */
    public function delete($key)
    {
        unset($this->values[$key]);

        return true;
    }

    public function clear()
    {
        $this->values = [];
    }

    public function getMultiple($keys, $default = null)
    {
        $ret = [];
        foreach ($keys as $key) {
            $ret[$key] = $this->get($key, $default);
        }

        return $ret;
    }

    public function setMultiple($values, $ttl = null)
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value);
        }

        return true;
    }

    public function deleteMultiple($keys)
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }

        return true;
    }

    public function has($key)
    {
        return isset($this->values[$key]);
    }
}