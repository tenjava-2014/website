<?php
namespace TenJava\Routing;


use Illuminate\Routing\Router;

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
            $this->router->get('/', "HomeController@index");
            $this->router->get('/points', 'PointsController@showLeaderboard');
            $this->router->get('/team', 'TeamController@showTeam');
            $this->router->get('/about', 'AboutController@showAbout');
            $this->router->get('/signup', 'SignupController@showSignUp');
            $this->router->get('/privacy', 'PrivacyController@showPrivacyInfo');
            $this->router->get('/oauth/refusal', 'AuthController@showRefusal');
            $this->router->get('/oauth/confirm', 'AuthController@loginWithGitHub');
            $this->router->get('/toggle-optout', 'AuthController@toggleOptout');
        });

        /* API - NO AUTH REQUIRED */
        $this->router->group(array(), function () {
            $this->router->get('/api/participants', 'ApiController@getParticipants');
            $this->router->get('/api/participants/confirmed/{confirmed}', 'ApiController@getConfirmedParticipants');
            $this->router->get('/api/points', 'ApiController@getPoints');
            $this->router->get('/api/session', 'ApiController@getSessionData');
        });

        /* GITHUB WEBHOOKS */
        $this->router->group(array(), function () {
            $this->router->post('/webhook/fire', 'WebhookController@processGitHubWebhook');
        });

        /* LOGGED IN USERS ONLY */
        $this->router->group(array('before' => 'AuthenticationFilter'), function () {
            $this->router->get('/register/participant', "AppController@showApplyParticipant");
            $this->router->post('/times/confirm', "TimeController@confirmUserTimes");
            $this->router->get('/times/select', "TimeController@showUserTimes");
            $this->router->get('/times/thanks', "TimeController@showThanks");
            $this->router->get('/register/judge', "AppController@showApplyJudge");

        });

        /* CSRF PROTECTED AUTH PAGES */
        $this->router->group(array('before' => 'AuthenticationFilter|csrf'), function () {
            $this->router->post('/apply/{type}', 'AppController@processApplication');
        });

        /* JUDGES ONLY */
        $this->router->group(array('before' => 'StaffFilter'), function () {
            $this->router->get('/list/{filter?}', 'AppController@listApps');
            $this->router->get('/test/staff', function() {
                return "Staff only test endpoint.";
            });
        });

        /* ORGANIZERS ONLY */
        $this->router->group(array('before' => 'AdminFilter'), function () {
            $this->router->post('/list/decline', 'AppController@declineJudgeApp');
            $this->router->post('/list/accept', 'AppController@acceptJudgeApp');
            $this->router->get('/test/admin', function() {
                return Response::json(["env" => App::environment()]);
            });
        });

    }
}