Scraper Spotify
===============

![Packagist version](https://flat.badgen.net/packagist/v/rem42/scraper-spotify)
![Packagist download](https://flat.badgen.net/packagist/dt/rem42/scraper-spotify)
![Packagist name](https://flat.badgen.net/packagist/name/rem42/scraper-spotify)
![Packagist php version](https://flat.badgen.net/packagist/php/rem42/scraper-spotify)
![Github licence](https://flat.badgen.net/github/license/rem42/scraper-spotify)
![Depenabot](https://flat.badgen.net/github/dependabot/rem42/scraper-spotify)

Scraper can handle multiple request type and transform them into object in order to create some API.

Installation
------------

````bash
composer require rem42/scraper-spotify
````

Requirement
-----------

- PHP >= 8.4

Usage
-----

The Spotify Web API needs an access token. Get one with the client credentials of your app
(https://developer.spotify.com/dashboard); it is valid for `expiresIn` seconds (1 hour).

````php
use Scraper\Scraper\Client;
use Scraper\ScraperSpotify\Request\SpotifyAlbumRequest;
use Scraper\ScraperSpotify\Request\SpotifySearchAlbumRequest;
use Scraper\ScraperSpotify\Request\SpotifyTokenRequest;
use Symfony\Component\HttpClient\HttpClient;

$client = new Client(HttpClient::create());

/** @var \Scraper\ScraperSpotify\Model\Token $token */
$token = $client->send(new SpotifyTokenRequest('clientId', 'clientSecret'));

/** @var \Scraper\ScraperSpotify\Model\SearchAlbum $search */
$search = $client->send(
    (new SpotifySearchAlbumRequest($token->accessToken))
        ->setQuery('eminem')
        ->setMarket('FR')
        ->setLimit(10)
);

foreach ($search->albums->items as $album) {
    echo $album->id, ' ', $album->name, ' (', $album->releaseDate?->format('Y'), ')', PHP_EOL;
}

/** @var \Scraper\ScraperSpotify\Model\Album $album */
$album = $client->send(
    (new SpotifyAlbumRequest($token->accessToken))
        ->setId('2cWBwpqMsDJC1ZUwz813lo')
        ->setMarket('FR')
);
````

Notes:

- Without `market` (and with a client credentials token), Spotify considers the content unavailable.
- Search `limit` is between 0 and 10 (default 5), `offset` between 0 and 1000.
- Since February 2026, development mode apps no longer get `label`, `popularity` and `available_markets` on albums: these properties stay `null` / empty.
