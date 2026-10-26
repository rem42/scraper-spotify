<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Tests\Request;

use Scraper\ScraperSpotify\Model\Album;
use Scraper\ScraperSpotify\Model\Artist;
use Scraper\ScraperSpotify\Model\Copyright;
use Scraper\ScraperSpotify\Model\Track;
use Scraper\ScraperSpotify\Model\Tracks;
use Scraper\ScraperSpotify\Request\SpotifyAlbumRequest;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @internal
 */
class SpotifyAlbumRequestTest extends AbstractRequestTestCase
{
    public function testSpotifyAlbumRequest(): void
    {
        $client = $this->getClient('album.json');

        $request = new SpotifyAlbumRequest('accessToken');
        $request
            ->setId('2cWBwpqMsDJC1ZUwz813lo')
            ->setMarket('FR')
        ;

        $result = $client->send($request);

        $this->assertInstanceOf(Album::class, $result);
        $this->assertEquals('The Eminem Show', $result->name);
        $this->assertInstanceOf(Artist::class, $result->artists[0]);
        $this->assertEquals('00606949329020', $result->externalIds?->upc);
        $this->assertInstanceOf(Copyright::class, $result->copyrights[0]);
        $this->assertEquals('C', $result->copyrights[0]->type);
        $this->assertInstanceOf(Tracks::class, $result->tracks);
        $this->assertEquals(2, $result->tracks->total);
        $this->assertInstanceOf(Track::class, $result->tracks->items[1]);
        $this->assertEquals('White America', $result->tracks->items[1]->name);
        $this->assertEquals(290320, $result->tracks->items[1]->durationMs);
        $this->assertTrue($result->tracks->items[1]->explicit);
        $this->assertTrue($result->tracks->items[1]->isPlayable);
        $this->assertInstanceOf(Artist::class, $result->tracks->items[1]->artists[0]);
    }

    public function requestCallback(string $method, string $url, array $options): ResponseInterface
    {
        $this->assertEquals('GET', $method);
        $this->assertEquals('https://api.spotify.com/v1/albums/2cWBwpqMsDJC1ZUwz813lo', $url);
        $this->assertEquals(['market' => 'FR'], $options['query']);

        return parent::requestCallback($method, $url, $options);
    }
}
