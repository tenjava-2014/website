<?php namespace TenJava\Providers;

use App;
use Artisan;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Foundation\Application;
use Illuminate\Html\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Factory;
use Log;
use Symfony\Component\HttpFoundation\Response;
use TenJava\Exceptions\FailedOauthException;
use TenJava\Exceptions\UnauthorizedException;
use View;

class AppServiceProvider extends ServiceProvider {

    public function boot(ViewFactory $view, Router $router) {
        $this->registerFormMacros();
        $factory = app('Illuminate\Contracts\View\Factory');
        $factory->composer('*', '\\TenJava\\Composers\\GlobalComposer');
        $this->registerRouteFilters($router);
    }

    private function registerFormMacros() {
        $app = $this->app;
        $app['form']->macro('judgeField', function ($name, $id, $max) use ($app) {
            $id = htmlentities($id);
            $fb = $this->app['form'];
            /** @var $fb FormBuilder */
            $old = $fb->old($id);
            $old = ($old === null) ? "0" : $old;
            $inputType = $fb->getSessionStore()->has("judge-use-num") ? 'number' : 'range';
            return '<div class="control-group"><label for="' . $id . '">' . $name . '</label> <output for="' . $id . '">(0/' . $max . ' points)</output>
                <div class="control"><input value="' . $old . '" type="' . $inputType . '" min="0" max="' . (int)$max . '" name="' . $id . '" id="' . $id . '"></div></div>';
        });
    }

    private function registerRouteFilters(Router $router) {
        $router->filter('staff', 'TenJava\Http\Filters\StaffFilter');
        $router->filter('organizer', 'TenJava\Http\Filters\OrganizerFilter');
        $router->filter('protected_api', 'TenJava\Http\Filters\ProtectedApiFilter');
    }

    /**
     * Register the TenJava IoC bindings.
     *
     * @return void
     */
    public function register() {
        $app = $this->app;

        // Interface bindings
        $app->bind("\\TenJava\\Notification\\IrcNotifierInterface", "\\TenJava\\Notification\\FlareBotIrcNotifier");
        $app->bind("\\TenJava\\Notification\\IrcMessageBuilderInterface", "\\TenJava\\Notification\\FlareBotMessageBuilder");
        $app->bind("\\TenJava\\Authentication\\EmailOptOutInterface", "\\TenJava\\Authentication\\GitHubEmailOptOut");
        $app->bind("\\TenJava\\Security\\HmacVerificationInterface", "\\TenJava\\Security\\HmacVerification");
        $app->bind("\\TenJava\\Security\\HmacCreationInterface", "\\TenJava\\Security\\HmacCreation");
        $app->bind("\\TenJava\\UrlShortener\\UrlShortenerInterface", "\\TenJava\\UrlShortener\\GitIoUrlShortener");
        $app->bind("\\TenJava\\Tools\\String\\StringTruncatorInterface", "\\TenJava\\Tools\\String\\StringTruncator");
        //$app->bind("\\TenJava\\Repository\\RepositoryActionInterface", "\\TenJava\\Repository\\EloquentRepositoryAction");
        $app->bind("\\TenJava\\CI\\BuildTriggerInterface", "\\TenJava\\CI\\JenkinsBuildTrigger");
        $app->bind("\\TenJava\\Time\\ContestTimesInterface", "\\TenJava\\Time\\ContestTimes");
        $app->bind("\\TenJava\\Repository\\ParticipantCommitRepositoryInterface", "\\TenJava\\Repository\\EloquentParticipantCommitRepository");
        $app->bind("\\TenJava\\CI\\BuildCreationInterface", "\\TenJava\\CI\\JenkinsBuildCreation");
        //$app->bind("\\TenJava\\Repository\\RepoWebhookInterface", "\\TenJava\\Repository\\GitHubRepoWebhook");
        $app->bind("\\TenJava\\Contest\\ParticipantRepositoryInterface", "\\TenJava\\Contest\\EloquentParticipantRepository");
        $app->bind("\\TenJava\\Contest\\TwitchRepositoryInterface", "\\TenJava\\Contest\\EloquentTwitchRepository");
        $app->bind("\\TenJava\\Contest\\JudgeClaimsInterface", "\\TenJava\\Contest\\EloquentJudgeClaims");
        $app->bind("\\TenJava\\Authentication\\UserImpersonationInterface", "\\TenJava\\Authentication\\GitHubUserImpersonation");
        $app->bind('\TenJava\Repository\UserRepositoryInterface', '\TenJava\Repository\UserRepository');

        // Singletons
        $app->singleton('GlobalComposer', '\\TenJava\\Composers\\GlobalComposer');

        // Error handlers
        $app->missing(function ($exception) use ($app) {
            return $app->make("\\TenJava\\Http\\Controllers\\ErrorController")->missing();
        });

        $app->error(function (UnauthorizedException $ignored) use ($app) {
            return $app->make('\\TenJava\\Http\\Controllers\\ErrorController')->unauthorized();
        });

        $app->error(function (FailedOauthException $exception) use ($app) {
            return $app->make('\\TenJava\\Http\\Controllers\\ErrorController')->oauth();
        });

        $app->down(function () {
            return View::make("errors.maintenance");
        });

        $this->registerCommands();
        $this->registerHeaders();
    }

    private function registerCommands() {
        $this->commands([
            "\\TenJava\\Console\\MailTestCommand",
            "\\TenJava\\Console\\RepoCleanupCommand",
            "\\TenJava\\Console\\TwitterUpdateCommand",
            "\\TenJava\\Console\\UserIdMigrateCommand",
            "\\TenJava\\Console\\UserDeleteCommand",
            "\\TenJava\\Console\\MailReminderCommand",
            //"\\TenJava\\Console\\RepoWebhookCommand",
            "\\TenJava\\Console\\AuthCleanupCommand",
            "\\TenJava\\Console\\JenkinsJobCommand",
            "\\TenJava\\Console\\JenkinsJobTriggerCommand",
            "\\TenJava\\Console\\TwitchCleanupCommand",
            "\\TenJava\\Console\\TwitchPollCommand",
            "\\TenJava\\Console\\MailInfoCommand",
            "\\TenJava\\Console\\TimeAnnounceCommand",
            "\\TenJava\\Console\\UserVerificationChecker",
            "\\TenJava\\Console\\MailNewsCommand",
            "\\TenJava\\Console\\MailAllParticipantsCommand"]);
    }

    private function registerHeaders() {
        /*$this->app->after(function ($request, $response) {
            $unsafes = '';
            if ($auth->isStaff()) {
                $unsafes = " 'unsafe-inline' 'unsafe-eval'";
            }
            if ($request->fullUrl() == "https://tenjava.com/charts") {
                $unsafes = " 'unsafe-inline' 'unsafe-eval'";
            }
            /*if ($request->secure()) {
                // Let's be extra strict for the sake of security
                $response->header('Content-Security-Policy',
                    "default-src 'self' https://results.tenjava.com:8181; " .
                    "style-src 'self' https://cdnjs.cloudflare.com https://fonts.googleapis.com 'unsafe-inline'; " .
                    "font-src 'self' https://cdnjs.cloudflare.com themes.googleusercontent.com https://fonts.gstatic.com; " .
                    "img-src 'self' https://*.githubusercontent.com http://edge.sf.hitbox.tv http://static-cdn.jtvnw.net http://placekitten.com; " . // this will likely need changing for twitch
                    "media-src 'self'; " . // this will likely need changing for twitch
                    "object-src 'self'; " . // this will likely need changing for twitch
                    "script-src 'self' https://cdnjs.cloudflare.com https://platform.twitter.com" . $unsafes
                );
                $response->header("X-Frame-Options", "SAMEORIGIN");
            } else {
                // We're in beta served over HTTP so we're not restricting stuff to SSL here
                $response->header('Content-Security-Policy',
                    "default-src 'self' https://results.tenjava.com:8181; " .
                    "style-src 'self' cdnjs.cloudflare.com fonts.googleapis.com 'unsafe-inline'; " .
                    "font-src 'self' cdnjs.cloudflare.com themes.googleusercontent.com fonts.gstatic.com; " .
                    "img-src 'self' https://*.githubusercontent.com edge.sf.hitbox.tv static-cdn.jtvnw.net http://placekitten.com; " . // this will likely need changing for twitch
                    "media-src 'self'; " . // this will likely need changing for twitch
                    "object-src 'self'; " . // this will likely need changing for twitch
                    "script-src 'self' cdnjs.cloudflare.com platform.twitter.com" . $unsafes
                );

                $response->header("X-Frame-Options", "SAMEORIGIN");
            }
        });*/
        // TODO: Fix
    }
}
