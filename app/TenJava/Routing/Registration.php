<?php
namespace TenJava\Routing;


use App;
use Illuminate\Routing\Router;
use Redirect;
use Response;
use Session;

class Registration {
    /**
     * @var \Illuminate\Routing\Router
     */
    private $router;

    public function __construct(Router $router) {
        $this->router = $router;
    }

    public function registerRoutes() {
        // TODO: Split into funcs
        /* NO AUTH REQUIRED */
        $this->router->group(array(), function () {
            $this->router->get('/', "TenJava\\Controllers\\Pages\\HomeController@index");
            $this->router->get('/points', 'TenJava\\Controllers\\Pages\\PointsController@showLeaderboard');
            $this->router->get('/team', 'TenJava\\Controllers\\Pages\\TeamController@showTeam');
            $this->router->get('/about', 'TenJava\\Controllers\\Pages\\AboutController@showAbout');
            $this->router->get('/signup', 'TenJava\\Controllers\\Pages\\SignupController@showSignUp');
            $this->router->get('/privacy', 'TenJava\\Controllers\\Pages\\PrivacyController@showPrivacyInfo');
            $this->router->get('/oauth/refusal', 'TenJava\\Controllers\\Authentication\\AuthController@showRefusal');
            $this->router->get('/oauth/confirm', 'TenJava\\Controllers\\Authentication\\AuthController@loginWithGitHub');
            $this->router->get('/toggle-optout', 'TenJava\\Controllers\\Authentication\\AuthController@toggleOptout');
            $this->router->get('/themest', 'TenJava\\Controllers\\Contest\\ThemesController@showThemes');
            $this->router->get('/wiki', function() {
                return Redirect::to("https://github.com/tenjava/resources/wiki");
            });
        });

        /* API - NO AUTH REQUIRED */
        $this->router->group(array(), function () {
            $this->router->get('/api/participants', 'TenJava\\Controllers\\Api\\ApiController@getParticipants');
            $this->router->get('/api/judges', 'TenJava\\Controllers\\Api\\ApiController@getActiveJudges');
            $this->router->get('/api/participants/confirmed/{confirmed}', 'TenJava\\Controllers\\Api\\ApiController@getConfirmedParticipants');
            $this->router->get('/api/points', 'TenJava\\Controllers\\Api\\ApiController@getPoints');
            $this->router->get('/api/session', 'TenJava\\Controllers\\Api\\ApiController@getSessionData');
        });

        /* GITHUB WEBHOOKS */
        $this->router->group(array(), function () {
            $this->router->post('/webhook/fire', 'TenJava\\Controllers\\Commit\\WebhookController@processGitHubWebhook');
        });

        /* JENKINS WEBHOOKS */
        $this->router->group(array(), function () {
            $this->router->post('/jenkins/fire', 'TenJava\\Controllers\\Jenkins\\WebhookController@processWebhook');
        });

        /* LOGGED IN USERS ONLY */
        $this->router->group(array('before' => 'AuthenticationFilter'), function () {
            $this->router->get('/register/participant', "TenJava\\Controllers\\Application\\AppController@showApplyParticipant");
            $this->router->post('/times/confirm', "TenJava\\Controllers\\Application\\TimeController@confirmUserTimes");
            $this->router->get('/times/select', "TenJava\\Controllers\\Application\\TimeController@showUserTimes");
            $this->router->get('/times/thanks', "TenJava\\Controllers\\Application\\TimeController@showThanks");
            $this->router->get('/register/judge', "TenJava\\Controllers\\Application\\AppController@showApplyJudge");
            $this->router->get('/login', function() {
               return Redirect::to("/");
            });
            $this->router->get('/logout', function() {
                Session::clear();
                return Redirect::to("/");
            });
        });

        /* CSRF PROTECTED AUTH PAGES */
        $this->router->group(array('before' => 'AuthenticationFilter|csrf'), function () {
            $this->router->post('/apply/{type}', 'TenJava\\Controllers\\Application\\AppController@processApplication');
        });

        /* JUDGES ONLY */
        $this->router->group(array('before' => 'StaffFilter'), function () {
            $this->router->get('/list/{filter?}', 'TenJava\\Controllers\\Application\\AppController@listApps');
            $this->router->get('/test/staff', function() {
                return "Staff only test endpoint.";
            });
        });

        /* ORGANIZERS ONLY */
        $this->router->group(array('before' => 'AdminFilter'), function () {
            $this->router->post('/list/decline', 'TenJava\\Controllers\\Application\\AppController@declineJudgeApp');
            $this->router->post('/list/accept', 'TenJava\\Controllers\\Application\\AppController@acceptJudgeApp');
            $this->router->post('/list/remove-participant', 'TenJava\\Controllers\\Application\\AppController@deleteUserEntry');
            $this->router->get('/test/admin', function() {
                return Response::json(["env" => App::environment()]);
            });
        });

    }
}
