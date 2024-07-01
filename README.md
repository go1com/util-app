GO1 App
====

Base microservice application.

## Cache service

The `cache` service will become `Doctrine\Common\Cache\ArrayCache` on testing.

```
# Memcache backend
$options = ['backend' => 'memcache', 'host' => '127.0.0.1', 'port' => '11211'];

# Memcached
$options = ['backend' => 'memcached', 'host' => '127.0.0.1', 'port' => '11211'];

# File system backend
$options = ['backend'   => 'filesystem', 'directory' => '/path/to/cache/'];

$app = new go1\App(['cacheOptions' => $options]);

// Acces `cache` service, instance of `Doctrine\Common\Cache\CacheProvider`
$cache = $app['cache'];
```

## Logging service

```
$options = ['name' => 'go1'];
$app = new go1\App(['logOptions' => $options]);

// Access `logger` service, instance of `Psr\Log\LoggerInterface`
$logger = $app['logger'];
```

## HTTP client service

```
$options = ['allow_redirects' => false];
$app = new go1\App(['clientOptions' => $options]);

// Access `client` service, instance of `GuzzleHttp\Client`
$client = $app['client'];
```

## How to test
    ./vendor/bin/phpunit --stop-on-failure
