<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Api;

use Scraper\ScraperSpotify\Model\Album;

class SpotifyAlbumApi extends AbstractSpotifyApi
{
    protected function getType(): string
    {
        return Album::class;
    }
}
