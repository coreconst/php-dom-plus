<?php

namespace PhpDomPlus\Tests\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PhpDomPlus\Service\HttpClient;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class HttpClientTest extends TestCase
{
    /** @var HttpClient */
    private $httpClient;

    /** @var Client|MockObject */
    private $clientMock;


    protected function setUp(): void
    {
        $this->clientMock = $this->createMock(Client::class);
        $this->httpClient = new HttpClient($this->clientMock);
    }


    public function testGetPageReturnsPageContent(): void
    {
        $url = 'http://example.com';
        $expectedContent = '<html>...</html>';

        $responseMock = new Response(200, [], $expectedContent);

        $this->clientMock->method('get')
            ->with($url)
            ->willReturn($responseMock);

        $content = $this->httpClient->getPage($url);

        $this->assertEquals($expectedContent, $content);
    }

    public function testGetPageThrowsExceptionOnError(): void
    {
        $url = 'http://example.com';

        $responseMock = new RequestException("Request failed", new Request('GET', $url));

        $this->clientMock->method('get')
            ->with($url)
            ->willThrowException($responseMock);

        $this->expectException(RequestException::class);

        $this->httpClient->getPage($url);
    }

}