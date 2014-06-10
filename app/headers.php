<?php
/**
 * This file contains any additional headers we're going to set for all our requests.
 * In our case, this is mostly going to be stuff for CSP rules.
 */

App::after(function ($request, $response) {
    /** @var Illuminate\Http\Response $response */
    /** @var Illuminate\Http\Request $request */
    if ($request->secure()) {
        // Let's be extra strict for the sake of security
        $response->header('Content-Security-Policy',
            "default-src 'self'; " .
            "style-src 'self' https://cdnjs.cloudflare.com; " .
            "font-src 'self' https://cdnjs.cloudflare.com; " .
            "img-src 'self'; " . // this will likely need changing for twitch
            "media-src 'self'; " . // this will likely need changing for twitch
            "object-src 'self'; " . // this will likely need changing for twitch
            "script-src 'self' https://cdnjs.cloudflare.com https://platform.twitter.com"
        );
    } else {
        // We're in beta served over HTTP so we're not restricting stuff to SSL here
        $response->header('Content-Security-Policy',
            "default-src 'self'; " .
            "style-src 'self' cdnjs.cloudflare.com; " .
            "font-src 'self' cdnjs.cloudflare.com; " .
            "img-src 'self'; " . // this will likely need changing for twitch
            "media-src 'self'; " . // this will likely need changing for twitch
            "object-src 'self'; " . // this will likely need changing for twitch
            "script-src 'self' cdnjs.cloudflare.com platform.twitter.com"
        );
    }
});