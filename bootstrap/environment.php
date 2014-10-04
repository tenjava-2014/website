<?php

/*
|--------------------------------------------------------------------------
| Detect The Application Environment
|--------------------------------------------------------------------------
|
| Laravel takes a dead simple approach to your application environments
| so you can just specify a machine name for the host that matches a
| given environment, then we will automatically detect it for you.
|
*/

/**
 * @var $app \Illuminate\Foundation\Application
 */
// $env = $app['env'] = 'replace_me';

$env = $app->detectEnvironment([

    'local' => ['David.local'],

]);
