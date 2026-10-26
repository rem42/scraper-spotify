<?php

declare(strict_types=1);

namespace Scraper\ScraperSpotify\Request;

use Scraper\Scraper\Attribute\Method;
use Scraper\Scraper\Attribute\Scheme;
use Scraper\Scraper\Attribute\Scraper;
use Scraper\Scraper\Request\RequestAuthBasic;
use Scraper\Scraper\Request\RequestBody;
use Scraper\Scraper\Request\RequestHeaders;
use Scraper\Scraper\Request\ScraperRequest;

#[Scraper(method: Method::POST, scheme: Scheme::HTTPS, host: 'accounts.spotify.com', path: 'api/token')]
class SpotifyTokenRequest extends ScraperRequest implements RequestAuthBasic, RequestBody, RequestHeaders
{
    public function __construct(
        protected readonly string $clientId,
        protected readonly string $clientSecret,
    ) {}

    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];
    }

    public function getBody(): array
    {
        return [
            'grant_type' => 'client_credentials',
        ];
    }

    public function getAuthBasic(): string
    {
        return $this->clientId . ':' . $this->clientSecret;
    }
}
