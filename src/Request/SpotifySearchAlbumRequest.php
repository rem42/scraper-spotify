<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Request;

use Scraper\Scraper\Attribute\Scraper;

#[Scraper(path: 'v1/search')]
class SpotifySearchAlbumRequest extends SpotifyRequest
{
    /** @var array<string, int|string|bool> */
    protected array $parameters = [
        'type' => 'album',
    ];

    public function setQuery(string $query): self
    {
        $this->parameters['q'] = $query;

        return $this;
    }

    /**
     * Range 0 - 10 (default 5).
     */
    public function setLimit(int $limit): self
    {
        $this->parameters['limit'] = $limit;

        return $this;
    }

    /**
     * Range 0 - 1000.
     */
    public function setOffset(int $offset): self
    {
        $this->parameters['offset'] = $offset;

        return $this;
    }
}
