<?php
/*
|--------------------------------------------------------------------------
| IoC container bindings
|--------------------------------------------------------------------------
|
| Register dependency injection bindings here.
|
*/

App::bind("AuthProviderInterface", "GitHubAuthProvider");
App::bind("EmailOptOutInterface", "GitHubEmailOptOut");
App::bind("Security\\HmacVerificationInterface", "Security\\HmacVerification");

App::singleton('GlobalComposer', function() {
    return new GlobalComposer();
});