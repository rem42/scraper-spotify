<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Model;

class Artist
{
    public ?ExternalUrls $externalUrls = null;
    public ?string $href = null;
    public ?string $id = null;
    public ?string $name = null;
    public ?string $type = null;
    public ?string $uri = null;
}
