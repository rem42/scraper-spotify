<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Api;

use Scraper\ScraperSpotify\Model\SearchAlbum;

class SpotifySearchAlbumApi extends AbstractSpotifyApi
{
    protected function getType(): string
    {
        return SearchAlbum::class;
    }
}
