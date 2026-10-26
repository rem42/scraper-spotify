<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Model;

class Track
{
    /** @var array<int, Artist> */
    public array $artists = [];

    /** @var array<int, string> */
    public array $availableMarkets = [];
    public ?int $discNumber = null;
    public ?int $durationMs = null;
    public ?bool $explicit = null;
    public ?ExternalUrls $externalUrls = null;
    public ?string $href = null;
    public ?string $id = null;
    public ?bool $isPlayable = null;
    public ?Restrictions $restrictions = null;
    public ?string $name = null;
    public ?string $previewUrl = null;
    public ?int $trackNumber = null;
    public ?string $type = null;
    public ?string $uri = null;
    public ?bool $isLocal = null;

    public function addArtist(Artist $artist): self
    {
        $this->artists[] = $artist;

        return $this;
    }
}
