<?php

namespace Raigu\TestDouble\Psr16;

use DateInterval;
use Psr\SimpleCache\CacheInterface;

final class InMemoryCache implements CacheInterface
{

    private array $values;
    private ClockInterface $clock;

    public function __construct(ClockInterface $clock = null)
    {
        $this->values = [];
        $this->clock = $clock ?? new PhpNativeClock;
    }

    public function get($key, $default = null)
    {
        $item = $this->values[$key] ?? [$default, PHP_INT_MAX];

        if ($item[1] <= $this->clock->now()->getTimestamp()) {
            return $default;
        }

        return $item[0];
    }

    public function set($key, $value, $ttl = null)
    {
        if (!is_null($ttl)) {
            $interval = ($ttl instanceof DateInterval)?$ttl:new DateInterval("PT{$ttl}S");
            $expirationDateTime = $this->clock->now()->add($interval)->getTimestamp();
        } else {
            $expirationDateTime = PHP_INT_MAX;
        }

        $this->values[$key] = [$value, $expirationDateTime];
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
            $this->set($key, $value, $ttl);
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
        if (isset($this->values[$key])) {
            $expirationDateTime = $this->values[$key][1];
            if ($expirationDateTime > $this->clock->now()->getTimestamp()) {
                return true;
            }
        }

        return false;
    }
}