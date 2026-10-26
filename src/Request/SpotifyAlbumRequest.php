<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Request;

use Scraper\Scraper\Attribute\Scraper;

#[Scraper(path: 'v1/albums/{id}')]
class SpotifyAlbumRequest extends SpotifyRequest
{
    protected string $id;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }
}
