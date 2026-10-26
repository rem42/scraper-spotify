<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Model;

class Albums extends Paging
{
    /** @var array<int, AlbumSearch> */
    public array $items = [];

    public function addItem(AlbumSearch $item): self
    {
        $this->items[] = $item;

        return $this;
    }
}
