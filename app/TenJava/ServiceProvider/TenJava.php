<?php
namespace TenJava\ServiceProvider;

use App;
use Artisan;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\ServiceProvider;
use TenJava\Exceptions\FailedOauthException;
use TenJava\Exceptions\UnauthorizedException;
use TenJava\Routing\Registration;
use View;

class TenJava extends ServiceProvider {

    /**
     * Register the TenJava IoC bindings.
     *
     * @return void
     */
    public function register() {
        $app = $this->app;
        // Interface bindings
        $app->bind("\\TenJava\\Authentication\\AuthProviderInterface", "\\TenJava\\Authentication\\GitHubAuthProvider");
        $app->bind("\\TenJava\\Notification\\IrcNotifierInterface", "\\TenJava\\Notification\\FlareBotIrcNotifier");
        $app->bind("\\TenJava\\Notification\\IrcMessageBuilderInterface", "\\TenJava\\Notification\\FlareBotMessageBuilder");
        $app->bind("\\TenJava\\Authentication\\EmailOptOutInterface", "\\TenJava\\Authentication\\GitHubEmailOptOut");
        $app->bind("\\TenJava\\Security\\HmacVerificationInterface", "\\TenJava\\Security\\HmacVerification");
        $app->bind("\\TenJava\\Security\\HmacVerificationInterface", "\\TenJava\\Security\\HmacVerification");
        $app->bind("\\TenJava\\UrlShortener\\UrlShortenerInterface", "\\TenJava\\UrlShortener\\GitIoUrlShortener");
        $app->bind("\\TenJava\\Tools\\String\\StringTruncatorInterface", "\\TenJava\\Tools\\String\\StringTruncator");
        $app->bind("\\TenJava\\Repository\\RepositoryActionInterface", "\\TenJava\\Repository\\EloquentRepositoryAction");
        $app->bind("\\TenJava\\CI\\BuildTriggerInterface", "\\TenJava\\CI\\JenkinsBuildTrigger");

        // Singletons
        $app->singleton('GlobalComposer', 'TenJava\Composers\GlobalComposer');

        // Error handlers
        $app->missing(function ($exception) use ($app) {
            return $app->make("\\TenJava\\Controllers\\ErrorController")->missing();
        });

        $app->error(function (UnauthorizedException $ignored) use ($app) {
            return $app->make('\\TenJava\\Controllers\\ErrorController')->unauthorized();
        });

        $app->error(function (FailedOauthException $exception) use ($app) {
            return $app->make('\\TenJava\\Controllers\\ErrorController')->oauth();
        });

        $app->down(function () {
            return View::make("errors.maintenance");
        });

        // View composers
        View::composer('*', 'GlobalComposer');

        $this->registerCommands();
        $this->registerHeaders();
        $this->registerFilters();
        $reg = new Registration($this->app['router']);
        $reg->registerRoutes();
    }

    private function registerCommands() {
        $this->commands([
            "\\TenJava\\Commands\\MailTestCommand",
            "\\TenJava\\Commands\\RepoCleanupCommand",
            "\\TenJava\\Commands\\TwitterUpdateCommand",
            "\\TenJava\\Commands\\UserIdMigrateCommand",
            "\\TenJava\\Commands\\UserDeleteCommand",
            "\\TenJava\\Commands\\MailReminderCommand",
            "\\TenJava\\Commands\\RepoWebhookCommand",
            "\\TenJava\\Commands\\AuthCleanupCommand",
            "\\TenJava\\Commands\\JenkinsJobCommand",
            "\\TenJava\\Commands\\JenkinsJobTriggerCommand",
            "\\TenJava\\Commands\\TwitchCleanupCommand",
            "\\TenJava\\Commands\\TwitchPollCommand"]);
    }

    private function registerFilters() {
        /** @var $router \Illuminate\Routing\Router */
        $router = $this->app['router'];
        /* @see AuthenticationFilter */
        $router->filter('AuthenticationFilter', '\\TenJava\\Filters\\AuthenticationFilter');
        /* @see StaffFilter */
        $router->filter('StaffFilter', '\\TenJava\\Filters\\StaffFilter');
        /* @see AdminFilter */
        $router->filter('AdminFilter', '\\TenJava\\Filters\\AdminFilter');
        /*
        |--------------------------------------------------------------------------
        | CSRF Protection Filter
        |--------------------------------------------------------------------------
        |
        | The CSRF filter is responsible for protecting your application against
        | cross-site request forgery attacks. If this special token in a user
        | session does not match the one given in this request, we'll bail.
        |
        */

        $router->filter('csrf', function () {
            if (\Session::token() != \Input::get('_token')) {
                throw new TokenMismatchException;
            }
        });
    }

    private function registerHeaders() {
        $this->app->after(function ($request, $response) {
            /** @var \TenJava\Authentication\AuthProviderInterface $auth */
            $auth = App::make("\\TenJava\\Authentication\\AuthProviderInterface");
            /** @var \Illuminate\Http\Response $response */
            /** @var \Illuminate\Http\Request $request */
            $unsafes = '';
            if ($auth->isStaff()) {
                $unsafes = " 'unsafe-inline' 'unsafe-eval'";
            }
            if ($request->secure()) {
                // Let's be extra strict for the sake of security
                $response->header('Content-Security-Policy',
                    "default-src 'self'; " .
                    "style-src 'self' https://cdnjs.cloudflare.com https://fonts.googleapis.com 'unsafe-inline'; " .
                    "font-src 'self' https://cdnjs.cloudflare.com themes.googleusercontent.com; " .
                    "img-src 'self'; " . // this will likely need changing for twitch
                    "media-src 'self'; " . // this will likely need changing for twitch
                    "object-src 'self'; " . // this will likely need changing for twitch
                    "script-src 'self' https://cdnjs.cloudflare.com https://platform.twitter.com" . $unsafes
                );
                $response->header("X-Frame-Options", "SAMEORIGIN");
            } else {
                // We're in beta served over HTTP so we're not restricting stuff to SSL here
                $response->header('Content-Security-Policy',
                    "default-src 'self'; " .
                    "style-src 'self' cdnjs.cloudflare.com fonts.googleapis.com 'unsafe-inline'; " .
                    "font-src 'self' cdnjs.cloudflare.com themes.googleusercontent.com; " .
                    "img-src 'self'; " . // this will likely need changing for twitch
                    "media-src 'self'; " . // this will likely need changing for twitch
                    "object-src 'self'; " . // this will likely need changing for twitch
                    "script-src 'self' cdnjs.cloudflare.com platform.twitter.com" . $unsafes
                );

                $response->header("X-Frame-Options", "SAMEORIGIN");
            }
        });

    }
}
