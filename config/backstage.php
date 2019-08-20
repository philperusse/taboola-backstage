<?php

return [

    // Credentials
    'client_id' => env('BACKSTAGE_CLIENT_ID'),
    'client_secret' => env('BACKSTAGE_CLIENT_SECRET'),

    'cache_lifetime_in_minutes' => 60 * 5, // 5 minutes

    'cpc' => [
        'min' => 0.03,
        'max' => 0.09,
    ],

    'logger' => \Psr\Log\NullLogger::class,
    'messageFormatter' => '',

];