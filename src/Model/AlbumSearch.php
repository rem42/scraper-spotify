<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Model;

class AlbumSearch
{
    public ?string $albumType = null;
    public ?int $totalTracks = null;

    /** @var array<int, string> */
    public array $availableMarkets = [];
    public ?ExternalUrls $externalUrls = null;
    public ?string $href = null;
    public ?string $id = null;

    /** @var array<int, Image> */
    public array $images = [];
    public ?string $name = null;
    public ?\DateTimeInterface $releaseDate = null;
    public ?string $releaseDatePrecision = null;
    public ?Restrictions $restrictions = null;
    public ?string $type = null;
    public ?string $uri = null;

    /** @var array<int, Artist> */
    public array $artists = [];

    public function addImage(Image $image): self
    {
        $this->images[] = $image;

        return $this;
    }

    public function addArtist(Artist $artist): self
    {
        $this->artists[] = $artist;

        return $this;
    }

    /**
     * Depending on release_date_precision, the date is "1981", "1981-12" or "1981-12-15".
     */
    public function setReleaseDate(string $releaseDate): self
    {
        foreach (['!Y-m-d', '!Y-m', '!Y'] as $format) {
            if ($dateTime = \DateTime::createFromFormat($format, $releaseDate)) {
                $this->releaseDate = $dateTime;

                break;
            }
        }

        return $this;
    }
}
