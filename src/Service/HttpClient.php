<?php

namespace PhpDomPlus\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HttpClient
{
    protected Client $client;

    private ?GuzzleException $exception = null;

    public function __construct(Client $client = null) {
        $this->client = $client ?: new Client([
            'headers' => [
                'Content-Type' => 'text/html',
            ],
        ]);
    }

    public function getPage($url): string|null
    {
        try {
            $page = $this->client->get($url);
            $this->exception = null;
            return $page->getBody();
        }catch (GuzzleException $exception) {
            $this->exception = $exception;
            return null;
        }
    }

    public function getException(): ?GuzzleException
    {
        return $this->exception ?? null;
    }
}