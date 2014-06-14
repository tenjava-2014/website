<?php
namespace TenJava\ServiceProvider;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory as ViewFactory;
use TenJava\Exceptions\FailedOauthException;
use TenJava\Exceptions\UnauthorizedException;

class TenJava extends ServiceProvider {

    /**
     * Register the TenJava IoC bindings.
     *
     * @return void
     */
    public function register() {
        $app = $this->app;
        $app->bind("TenJava\\Authentication\\AuthProviderInterface", "\\TenJava\\Authentication\\GitHubAuthProvider");
        $app->bind("TenJava\\Authentication\\EmailOptOutInterface", "TenJava\\Authentication\\GitHubEmailOptOut");
        $app->bind("TenJava\\Security\\HmacVerificationInterface", "TenJava\\Security\\HmacVerification");

        $app->singleton('GlobalComposer', 'TenJava\Composers\GlobalComposer');

        $app->missing(function ($exception) use ($app) {
            return $app->make("TenJava\\Controllers\\ErrorController")->missing();
        });

        $app->error(function (UnauthorizedException $exception) use ($app) {
            return $app->make('TenJava\\Controllers\\ErrorController')->unauthorized();
        });

        $app->error(function (FailedOauthException $exception) use ($app) {
            return $app->make('TenJava\\Controllers\\ErrorController')->oauth();
        });

        $app->down(function () {
            return Response::make("Be right back!", 503);
        });

        \View::composer('*', 'GlobalComposer');
        
        $app->make("TenJava\\Routing\\Registration")->registerRoutes();
    }
}
