<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Model;

class Album extends AlbumSearch
{
    public ?Tracks $tracks = null;

    /** @var array<int, Copyright> */
    public array $copyrights = [];
    public ?ExternalIds $externalIds = null;

    /** @var array<int, string> */
    public array $genres = [];
    public ?string $label = null;
    public ?int $popularity = null;

    public function addCopyright(Copyright $copyright): self
    {
        $this->copyrights[] = $copyright;

        return $this;
    }
}
