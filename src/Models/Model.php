<?php

namespace Taboola\Backstage\Models;

use Taboola\Backstage\Backstage;
use Taboola\Backstage\BackstageClient;
use philperusse\Api\AbstractCrudObject;
use philperusse\Api\Concerns\NeedsAttribute;
use philperusse\Api\Concerns\ValidatesParameters;

class Model extends AbstractCrudObject
{
    use NeedsAttribute;
    use ValidatesParameters;

    public function __construct($attributes = [])
    {

        return parent::__construct(resolve(BackstageClient::class), $attributes);
    }

    public static function __callStatic($method, $parameters)
    {
        return (new static())->$method(...$parameters);
    }

}
