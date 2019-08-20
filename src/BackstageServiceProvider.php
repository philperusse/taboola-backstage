<?php

namespace Taboola\Backstage;

use Illuminate\Support\ServiceProvider;
use Taboola\Backstage\Exceptions\InvalidConfiguration;
use Psr\Log\NullLogger;

class BackstageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/backstage.php' => config_path('backstage.php'),
        ], 'backstage-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/backstage.php', 'backstage');

        $this->app->singleton(BackstageClient::class, function ($app) {

            $config = config('backstage');
            $this->guardAgainstInvalidConfiguration($config);

            $service = new BackstageClient;
            $service->credentials($config['client_id'], $config['client_secret']);

            if($config['messageFormatter']) {
                $service->setLogger(with(new \Monolog\Logger('Backstage'))->pushHandler(
                    new \Monolog\Handler\RotatingFileHandler(storage_path('logs/Backstage.log'))
                ), $config['messageFormatter']);
            }

            $service->setCacheLifetime($config['cache_lifetime_in_minutes']);

            return $service;
        });

        $this->app->singleton(Backstage::class, function($app){

            $client = app(BackstageClient::class);

            return new Backstage($client);
        });

        $this->app->alias(Backstage::class, 'taboola-backstage');

    }

    public function provides()
    {
        return [ Backstage::class ];
    }

    protected function guardAgainstInvalidConfiguration(array $config = null)
    {
        if (empty($config['client_id'])) {
            throw InvalidConfiguration::clientIdNotSpecified();
        }

        if (empty($config['client_secret'])) {
            throw InvalidConfiguration::clientSecretNotSpecified();
        }

    }
}