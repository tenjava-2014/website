<?php

App::error(function (FailedOauthException $exception) {
    return App::make('ErrorController')->oauth();
});

class FailedOauthException extends \Exception {}