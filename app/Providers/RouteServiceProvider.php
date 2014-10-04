<?php namespace TenJava\Providers;

use App;
use Auth;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Redirect;
use Response;
use Session;

class RouteServiceProvider extends ServiceProvider {

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @param  Router $router
     * @param  UrlGenerator $url
     * @return void
     */
    public function before(Router $router, UrlGenerator $url) {
        $url->setRootControllerNamespace('TenJava\Http\Controllers');
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map() {
        // Once the application has booted, we will include the default routes
        // file. This "namespace" helper will load the routes file within a
        // route group which automatically sets the controller namespace.
        $this->app->booted(function () {
            $this->namespaced('TenJava\Http\Controllers', function (Router $router) {
                require app_path() . '/Http/routes.php';
            });
        });

        $this->routeFilters();

        /* NO AUTH REQUIRED */
        $this->routeNoAuthPages();

        /* LOGGED IN USERS ONLY */
        $this->routeAuthPages();

        /* API - NO AUTH REQUIRED */
        $this->routeNoAuthAPI();

        /* AUTHED API CLIENTS ONLY */
        $this->routeAuthAPI();

        /* WEBHOOKS */
        $this->routeWebhooks();

        /* CSRF PROTECTED AUTH PAGES */
        $this->routeCSRFAuthPages();

        /* JUDGES ONLY */
        $this->routeJudgePages();

        /* ORGANIZERS ONLY */
        $this->routeOrganizerPages();
    }

    private function routeFilters() {
        $this->filter('staff', 'TenJava\Http\Filters\StaffFilter');
        $this->filter('organizer', 'TenJava\Http\Filters\OrganizerFilter');
    }

    private function routeNoAuthPages() {
        $this->group(array(), function () {
            $this->get('/', ['as' => 'index', 'uses' => "TenJava\\Http\\Controllers\\Pages\\HomeController@index"]);
            $this->get('/login', "TenJava\\Http\\Controllers\\Authentication\\AuthController@loginWithGitHub");
            $this->get('/streams', "TenJava\\Http\\Controllers\\Pages\\HomeController@showStreams");
            $this->get('/ajax/commits', "TenJava\\Http\\Controllers\\Pages\\HomeController@ajaxCommits");
            $this->get('/points', 'TenJava\\Http\\Controllers\\Pages\\PointsController@showLeaderboard');
            $this->get('/team', 'TenJava\\Http\\Controllers\\Pages\\TeamController@showTeam');
            $this->get('/team/stats', 'TenJava\\Http\\Controllers\\Pages\\TeamController@showJudgingStats');
            $this->get('/about', 'TenJava\\Http\\Controllers\\Pages\\AboutController@showAbout');
            $this->get('/privacy', 'TenJava\\Http\\Controllers\\Pages\\PrivacyController@showPrivacyInfo');
            $this->get('/toggle-optout', 'TenJava\\Http\\Controllers\\Authentication\\AuthController@toggleOptout');
            $this->get('/themes', 'TenJava\\Http\\Controllers\\Contest\\ThemesController@showThemes');
            $this->get('/results', "TenJava\\Http\\Controllers\\Pages\\ResultsController@showContestResults");
            $this->get('/wiki', 'TenJava\Http\Controllers\Pages\HomeController@wiki');
        });
    }

    private function routeAuthPages() {
        $this->group(array('before' => 'auth'), function () {
            /*$this->get('/register/participant', "TenJava\\Http\\Controllers\\Application\\AppController@showApplyParticipant");
            $this->post('/times/confirm', "TenJava\\Http\\Controllers\\Application\\TimeController@confirmUserTimes");
            $this->get('/times/select', "TenJava\\Http\\Controllers\\Application\\TimeController@showUserTimes");
            $this->get('/times/thanks', "TenJava\\Http\\Controllers\\Application\\TimeController@showThanks");
            $this->get('/register/judge', "TenJava\\Http\\Controllers\\Application\\AppController@showApplyJudge");
            $this->get('/charts', 'TenJava\\Http\\Controllers\\Pages\\ChartsController@showCharts');
            $this->get('/feedback', 'TenJava\\Http\\Controllers\\Pages\\FeedbackController@showFeedback');
            $this->post('/feedback', 'TenJava\\Http\\Controllers\\Pages\\FeedbackController@sendFeedback');
            $this->get('/verification/key', "TenJava\\Http\\Controllers\\Pages\\VerificationController@getVerificationKey");*/
            $this->get('/logout', "TenJava\\Http\\Controllers\\Authentication\\AuthController@logout");
            $this->get('/subscribe', 'TenJava\\Http\\Controllers\\Pages\\NewsController@showSubscribePage');
            $this->post('/resend-confirmation', 'TenJava\\Http\\Controllers\\Pages\\NewsController@resendConfirmationEmail');
            $this->get('/resend-confirmation/thanks', ['uses' => 'TenJava\\Http\\Controllers\\Pages\\NewsController@showResendConfirmation', 'as' => "resend-thanks"]);
            $this->model('subscription', 'TenJava\\Models\\Subscription');
            $this->get('/confirm/{subscription}/{sha1}', 'TenJava\\Http\\Controllers\\Pages\\NewsController@confirm');
            $this->get('/unsubscribe/{subscription}/{sha1}', 'TenJava\\Http\\Controllers\\Pages\\NewsController@unsubscribeDirectly');
        });
    }

    private function routeNoAuthAPI() {
        $this->group(array(), function () {
//            $this->get('/api/participants', 'TenJava\\Http\\Controllers\\Api\\ApiController@getParticipants');
//            $this->get('/api/checkParticipant/{participant}', 'TenJava\\Http\\Controllers\\Api\\ApiController@didParticipantParticipate');
            $this->get('/api/judges', 'TenJava\\Http\\Controllers\\Api\\ApiController@getActiveJudges');
            $this->get('/api/team/stats', 'TenJava\\Http\\Controllers\\Api\\ApiController@getJudgeStats');
//            $this->get('/api/participants/confirmed/{confirmed}', 'TenJava\\Http\\Controllers\\Api\\ApiController@getConfirmedParticipants');
//            $this->get('/api/points', 'TenJava\\Http\\Controllers\\Api\\ApiController@getPoints');
//            $this->get('/api/session', 'TenJava\\Http\\Controllers\\Api\\ApiController@getSessionData');
        });
    }

    private function routeAuthAPI() {
        $this->group(array('before' => 'ProtectedApiFilter'), function () {
//            $this->get('/api/judges/claims', 'TenJava\\Http\\Controllers\\Api\\ApiController@getJudgeClaims');
        });
    }

    private function routeWebhooks() {
        /* GITHUB WEBHOOKS */
        $this->group(array(), function () {
//            $this->post('/webhook/fire', 'TenJava\\Http\\Controllers\\Commit\\WebhookController@processGitHubWebhook');
        });

        /* JENKINS WEBHOOKS */
        $this->group(array(), function () {
//            $this->post('/jenkins/fire', 'TenJava\\Http\\Controllers\\Jenkins\\WebhookController@processWebhook');
        });
    }

    private function routeCSRFAuthPages() {
        $this->group(array('before' => 'auth|csrf'), function () {
//            $this->post('/apply/{type}', 'TenJava\\Http\\Controllers\\Application\\AppController@processApplication');
            $this->post('/subscribe', 'TenJava\\Http\\Controllers\\Pages\\NewsController@subscribe');
            $this->post('/unsubscribe', 'TenJava\\Http\\Controllers\\Pages\\NewsController@unsubscribe');
        });
    }

    private function routeJudgePages() {
        $this->group(['before' => 'staff'], function () {
            $this->get('/judging', 'TenJava\\Http\\Controllers\\Judging\\DashboardController@showDashboard');
            $this->get('/judging/oversight', 'TenJava\\Http\\Controllers\\Judging\\OversightController@showOversight');
            $this->get('/judging/oversight/{id}', 'TenJava\\Http\\Controllers\\Judging\\OversightController@showOversightForm');
            $this->post('/judging/oversight/{id}', 'TenJava\\Http\\Controllers\\Judging\\OversightController@processOversight');
            $this->get('/judging/help', 'TenJava\\Http\\Controllers\\Judging\\HelpController@showHelp');
            $this->get('/judging/plugins', 'TenJava\\Http\\Controllers\\Judging\\JudgingController@showLatestPlugin');
            $this->get('/judging/plugins/toggle', 'TenJava\\Http\\Controllers\\Judging\\JudgingController@toggleInputMethod');
            $this->post('/judging/plugins', 'TenJava\\Http\\Controllers\\Judging\\JudgingController@judgePlugin');
//            $this->get('/list/{filter?}', 'TenJava\\Http\\Controllers\\Application\\AppController@listApps');
            $this->get('/test/staff', 'TenJava\Http\Controllers\Pages\HomeController@staffTest');
            $this->get('/judging/logs/ajax', 'TenJava\\Http\\Controllers\\Judging\\LogViewController@testHmac');
            $this->get('/judging/logs', 'TenJava\\Http\\Controllers\\Judging\\LogViewController@showLogs');

        });
    }

    private function routeOrganizerPages() {
        $this->group(array('before' => 'organizer'), function () {
//            $this->post('/list/decline', 'TenJava\\Http\\Controllers\\Application\\AppController@declineJudgeApp');
//            $this->post('/list/accept', 'TenJava\\Http\\Controllers\\Application\\AppController@acceptJudgeApp');
//            $this->post('/list/remove-participant', 'TenJava\\Http\\Controllers\\Application\\AppController@deleteUserEntry');
            $this->get('/test/admin', 'TenJava\Http\Controllers\Pages\HomeController@adminTest');
//            $this->get('/judging/feedback', 'TenJava\\Http\\Controllers\\Judging\\ViewFeedbackController@showFeedback');
//            $this->get('/judging/results-viewer/{repoName}', 'TenJava\\Http\\Controllers\\Judging\\ReviewController@displayResultsForParticipant');
        });
    }

}
