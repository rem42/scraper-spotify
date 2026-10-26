<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Tests\Request;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Scraper\Scraper\Client;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @internal
 */
abstract class AbstractRequestTestCase extends TestCase
{
    private MockObject|ResponseInterface $responseInterface;

    protected function getClient(string $fixture): Client
    {
        $this->responseInterface = $this->createStub(ResponseInterface::class);
        $this->responseInterface
            ->method('getStatusCode')->willReturn(200)
        ;
        $this->responseInterface
            ->method('getContent')->willReturn(file_get_contents(__DIR__ . '/../fixtures/' . $fixture))
        ;
        $httpClient = $this->createStub(HttpClientInterface::class);
        $httpClient
            ->method('request')->willReturnCallback([$this, 'requestCallback'])
        ;

        return new Client($httpClient);
    }

    public function requestCallback(string $method, string $url, array $options): ResponseInterface
    {
        $this->assertAuthentication($options);

        return $this->responseInterface;
    }

    /**
     * @param array<string, mixed> $options
     */
    protected function assertAuthentication(array $options): void
    {
        $this->assertArrayHasKey('auth_bearer', $options);
        $this->assertEquals('accessToken', $options['auth_bearer']);
    }
}
