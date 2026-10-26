<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Api;

use Scraper\ScraperSpotify\Model\Token;

class SpotifyTokenApi extends AbstractSpotifyApi
{
    protected function getType(): string
    {
        return Token::class;
    }
}
