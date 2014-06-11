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
App::bind("TenJava\\Security\\HmacVerificationInterface", "TenJava\\Security\\HmacVerification");

App::singleton('GlobalComposer', function() {
    return new GlobalComposer();
});