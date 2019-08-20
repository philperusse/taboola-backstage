<?php
namespace Taboola\Backstage\Exceptions;

use Exception;

class InvalidConfiguration extends Exception
{
    public static function clientIdNotSpecified()
    {
        return new static('Client ID was not specified in config');
    }

    public static function clientSecretNotSpecified()
    {
        return new static('Client Secret was not specified in config');
    }

}