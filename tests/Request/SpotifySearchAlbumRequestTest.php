<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Tests\Request;

use Scraper\ScraperSpotify\Model\Albums;
use Scraper\ScraperSpotify\Model\AlbumSearch;
use Scraper\ScraperSpotify\Model\Artist;
use Scraper\ScraperSpotify\Model\Image;
use Scraper\ScraperSpotify\Model\SearchAlbum;
use Scraper\ScraperSpotify\Request\SpotifySearchAlbumRequest;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @internal
 */
class SpotifySearchAlbumRequestTest extends AbstractRequestTestCase
{
    public function testSpotifySearchAlbumRequest(): void
    {
        $client = $this->getClient('search_album.json');

        $request = new SpotifySearchAlbumRequest('accessToken');
        $request
            ->setQuery('eminem')
            ->setMarket('FR')
            ->setLimit(2)
        ;

        $result = $client->send($request);

        $this->assertInstanceOf(SearchAlbum::class, $result);
        $this->assertInstanceOf(Albums::class, $result->albums);
        $this->assertEquals(800, $result->albums->total);
        $this->assertCount(2, $result->albums->items);
        $this->assertInstanceOf(AlbumSearch::class, $result->albums->items[0]);
        $this->assertEquals('2cWBwpqMsDJC1ZUwz813lo', $result->albums->items[0]->id);
        $this->assertEquals('The Eminem Show', $result->albums->items[0]->name);
        $this->assertEquals('album', $result->albums->items[0]->albumType);
        $this->assertEquals('https://open.spotify.com/album/2cWBwpqMsDJC1ZUwz813lo', $result->albums->items[0]->externalUrls?->spotify);
        $this->assertEquals('2002-05-26', $result->albums->items[0]->releaseDate?->format('Y-m-d'));
        $this->assertInstanceOf(Image::class, $result->albums->items[0]->images[0]);
        $this->assertEquals(640, $result->albums->items[0]->images[0]->width);
        $this->assertInstanceOf(Artist::class, $result->albums->items[0]->artists[0]);
        $this->assertEquals('Eminem', $result->albums->items[0]->artists[0]->name);
        $this->assertEquals('year', $result->albums->items[1]->releaseDatePrecision);
        $this->assertEquals('2005-01-01', $result->albums->items[1]->releaseDate?->format('Y-m-d'));
    }

    public function requestCallback(string $method, string $url, array $options): ResponseInterface
    {
        $this->assertEquals('GET', $method);
        $this->assertEquals('https://api.spotify.com/v1/search', $url);
        $this->assertArrayHasKey('query', $options);
        $this->assertEquals([
            'type' => 'album',
            'q' => 'eminem',
            'market' => 'FR',
            'limit' => 2,
        ], $options['query']);

        return parent::requestCallback($method, $url, $options);
    }
}
