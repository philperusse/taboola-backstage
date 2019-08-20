<?php

namespace Taboola\Backstage;

class Backstage
{
    /** @var BackstageClient */
    protected $client;

    public function __construct(BackstageClient $client)
    {
        $this->client = $client;
    }

    public function __call($method, $params)
    {
        $class = __NAMESPACE__ .'\\Models\\'.  ucfirst($method);
        if(class_exists($class)) {
            return new $class(...$params);
        }
    }
}