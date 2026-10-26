<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Request;

use Scraper\Scraper\Attribute\Method;
use Scraper\Scraper\Attribute\Scheme;
use Scraper\Scraper\Attribute\Scraper;
use Scraper\Scraper\Request\RequestAuthBearer;
use Scraper\Scraper\Request\RequestQuery;
use Scraper\Scraper\Request\ScraperRequest;

#[Scraper(method: Method::GET, scheme: Scheme::HTTPS, host: 'api.spotify.com')]
abstract class SpotifyRequest extends ScraperRequest implements RequestAuthBearer, RequestQuery
{
    /** @var array<string, int|string|bool> */
    protected array $parameters = [];

    public function __construct(
        protected string $accessToken,
    ) {}

    public function getBearer(): string
    {
        return $this->accessToken;
    }

    /**
     * @return array<string, bool|int|string>
     */
    public function getQuery(): array
    {
        return $this->parameters;
    }

    /**
     * ISO 3166-1 alpha-2 country code: without it, content is considered unavailable for a client credentials token.
     */
    public function setMarket(string $market): self
    {
        $this->parameters['market'] = $market;

        return $this;
    }
}
