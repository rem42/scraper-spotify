<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Model;

class Token
{
    public ?string $accessToken = null;
    public ?string $tokenType = null;
    public ?int $expiresIn = null;
}
