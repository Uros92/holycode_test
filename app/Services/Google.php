<?php

namespace App\Services;

use Google_Client;
use GuzzleHttp\Client;

abstract class Google
{
    const DEVELOPER_KEY = 'AIzaSyBS5hhCpAmEfXhv4nTSX1HQHreZENMuYW4';
    // Google client that will be used by Youtube for connection with google service
    protected $google_client;
    // Guzzle client that will fix no ssl on local environment
    protected $http_client;

    /**
     * Google constructor.
     */
    public function __construct()
    {
        // Handle HTTPS failed requests (no ssl on local)
        $this->http_client = new Client([
            'verify' => false
        ]);

        // Google client
        $this->google_client = new Google_Client();
        $this->google_client->setHttpClient($this->http_client);
        $this->google_client->setDeveloperKey(self::DEVELOPER_KEY);
    }
}
