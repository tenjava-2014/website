<?php namespace TenJava\UrlShortener;


interface UrlShortenerInterface {

    /**
     * @param string $url The URL to shorten.
     * @param string|null $custom Custom identifier.
     * @return string The shortened URL.
     */
    public function shortenUrl($url, $custom = null);

}
