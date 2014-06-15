<?php
namespace TenJava\UrlShortener;

use GuzzleHttp\Client as GuzzleClient;

class GitIoUrlShortener implements UrlShortenerInterface {

    /**
     * @param string $url The URL to shorten.
     * @param string|null $custom Custom identifier.
     * @return string The shortened URL.
     */
    public function shortenUrl($url, $custom=null) {
        $client = new GuzzleClient();
        $response = $client->post("http://git.io", ['body' => ['url' => $url, 'code' => $custom]]);
        return $response->getHeader("Location");
    }
}