<?php


namespace App\Services;


use GuzzleHttp\Client;

class Wikipedia
{
    // Guzzle client
    protected $http_client;
    public $data;
    // Numbers that wikipedia returns for countries
    public $mapped_keys_from_wikipedia_pages = [
        'gb' => 13530298,
        'nl' => 21148,
        'de' => 76972,
        'fr' => 5843419,
        'es' => 26667,
        'it' => 14532,
        'gr' => 12108
    ];

    public function __construct()
    {
        // Handle HTTPS failed requests (no ssl on local)
        $this->http_client = new Client([
            'verify' => false
        ]);
        // Use wikipedia api call and set global wikipedia data for countries
        $this->setWikipediaData();
    }

    /**
     * Connect with wikipedia api and
     * set wikipedia data for countries
     */
    protected function setWikipediaData()
    {
        $result = $this->http_client->get(
            'https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro&explaintext&redirects=1&titles=France|Great_Britain|Netherlands|Denmark|Spain|Italy|Greece'
        );

        // Assoc array
        if($result->getStatusCode() === 200) {
            $this->data = json_decode($result->getBody()->getContents(), true)['query']['pages'];
        }
    }
}
