<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Model;

class Paging
{
    public ?string $href = null;
    public ?int $limit = null;
    public ?string $next = null;
    public ?int $offset = null;
    public ?string $previous = null;
    public ?int $total = null;
}
