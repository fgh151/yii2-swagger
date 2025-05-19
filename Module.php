<?php

namespace fgh151\swagger;

use yii\base\Module as BaseModule;
use yii\caching\CacheInterface;

class Module extends BaseModule
{
    public array $sources = [];
    public string $schema = '/swagger/swagger/doc';

    /**
     * @var bool whether to enable schema caching.
     * Note that in order to enable truly schema caching, a valid cache component as specified
     * by [[cache]] must be enabled and [[enableCache]] must be set true.
     * @see cacheDuration
     * @see cache
     */
    public bool $enableCache = false;
    /**
     * @var int number of seconds that table metadata can remain valid in cache.
     * Use 0 to indicate that the cached data will never expire.
     * @see enableCache
     */
    public int $cacheDuration = 3600;
    /**
     * @var CacheInterface|string the cache object or the ID of the cache application component that
     * is used to cache the table metadata.
     * @see enableCache
     */
    public string|CacheInterface $cache = 'cache';

    public function init()
    {
        $this->controllerNamespace = 'fgh151\swagger\controllers';
        parent::init();
    }
}