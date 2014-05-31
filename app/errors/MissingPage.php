<?php
App::missing(function ($exception) {
    return App::make("ErrorController")->missing();
});