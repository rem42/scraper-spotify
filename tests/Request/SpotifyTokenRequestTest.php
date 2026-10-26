<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Tests\Request;

use Scraper\ScraperSpotify\Model\Token;
use Scraper\ScraperSpotify\Request\SpotifyTokenRequest;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @internal
 */
class SpotifyTokenRequestTest extends AbstractRequestTestCase
{
    public function testSpotifyTokenRequest(): void
    {
        $client = $this->getClient('token.json');

        $result = $client->send(new SpotifyTokenRequest('clientId', 'clientSecret'));

        $this->assertInstanceOf(Token::class, $result);
        $this->assertEquals('Bearer', $result->tokenType);
        $this->assertEquals(3600, $result->expiresIn);
        $this->assertNotEmpty($result->accessToken);
    }

    public function requestCallback(string $method, string $url, array $options): ResponseInterface
    {
        $this->assertEquals('POST', $method);
        $this->assertEquals('https://accounts.spotify.com/api/token', $url);
        $this->assertEquals(['grant_type' => 'client_credentials'], $options['body']);

        return parent::requestCallback($method, $url, $options);
    }

    protected function assertAuthentication(array $options): void
    {
        $this->assertArrayNotHasKey('auth_bearer', $options);
        $this->assertEquals('clientId:clientSecret', $options['auth_basic']);
    }
}
