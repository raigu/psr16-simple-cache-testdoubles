[![Latest Stable Version](http://poser.pugx.org/raigu/psr16-simple-cache-testdoubles/v/stable)](https://packagist.org/packages/raigu/psr16-simple-cache-testdoubles)
[![Fallows SemVer](https://img.shields.io/badge/SemVer-2.0.0-green)](https://semver.org/spec/v2.0.0.html)
[![build](https://github.com/raigu/psr16-simple-cache-testdoubles/workflows/build/badge.svg)](https://github.com/raigu/psr16-simple-cache-testdoubles/actions)
[![codecov](https://codecov.io/gh/raigu/psr16-simple-cache-testdoubles/branch/main/graph/badge.svg?token=XII3CBEZSG)](https://codecov.io/gh/raigu/psr16-simple-cache-testdoubles)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)


# psr16-simple-cache-testdoubles

Test Doubles for PSR-16 simple cache

# Dependency

* [psr/simple-cache==^1.0](https://packagist.org/packages/psr/simple-cache)

# Install

```shell
$ composer require --dev raigu/psr16-simple-cache-testdoubles
```

# Usage

## In-memory stub

Caches in memory. 

```php
$sut = new \Raigu\TestDouble\Psr16\InMemoryCache;

$sut->set('1', 'a value');

assert($sut->has('1'))
assert($sut->get('1') === 'a value')
```

## Disconnected cache stub

Behaves like a cache over network which has connection issues and is disconnected.

```php

$sut = new \Raigu\TestDouble\Psr16\DisconnectedCacheStub;

assert($sut->set(1, 'value') === false);
assert($sut->has(1) === false);
assert($sut->get(1, 'default') === 'default');
assert($sut->getMultiple([1], 'default') === [1 => 'default']);
assert($sut->setMultiple([2 => 'value']) === false);
assert($sut->delete(1, 'value') === false);
assert($sut->deleteMultiple([1, 2]) === false);
assert($sut->clear() === false);)
```

# Testing

```shell
$ composer test
$ composer specification 
$ composer coverage
```