<?php

namespace PhpDomPlus\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HttpClient
{
    protected Client $client;

    public function __construct(Client $client = null) {
        $this->client = $client ?: new Client([
            'headers' => [
                'Content-Type' => 'text/html',
            ],
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function getPage($url): string
    {
        $page = $this->client->get($url);
        return $page->getBody();
    }
}