<?php

App::error(function (UnauthorizedException $exception) {
    return App::make('ErrorController')->unauthorized();
});

class UnauthorizedException extends \Exception {}