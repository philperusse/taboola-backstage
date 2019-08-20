<?php
namespace Taboola\Backstage;

use philperusse\Api\Tokened;

class BackstageClient extends Tokened
{
    protected $oauth_endpoint = 'https://backstage.taboola.com/backstage/oauth/token';
    protected $endpoint= 'https://backstage.taboola.com/backstage/api/1.0/';
    protected $cache_key = 'taboola:backstage:access_token';

    // Surprisingly the oauthEndpoint is not within the API base endpoint url...
    public function oauthEndpoint()
    {
        return $this->oauth_endpoint;
    }

    public function credentials($clientId, $clientSecret)
    {
        $this->setAuthPayload([
            'query' => [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'grant_type' => 'client_credentials',
            ]
        ]);
    }
}