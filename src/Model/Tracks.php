<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Model;

class Tracks extends Paging
{
    /** @var array<int, Track> */
    public array $items = [];

    public function addItem(Track $item): self
    {
        $this->items[] = $item;

        return $this;
    }
}
