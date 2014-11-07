<?php namespace TenJava\Providers;

use Illuminate\Support\ServiceProvider;
use Markdown;
use Stripe;

class RegistrationServiceProvider extends ServiceProvider {

    public function boot() {
        $this->registerFormMacros();
        $factory = app('Illuminate\Contracts\View\Factory');
        $factory->composer('*', '\TenJava\Composers\GlobalComposer');
        Markdown::getParsedown()->setMarkupEscaped(true);
        Stripe::setApiKey($_ENV['STRIPE_KEY']);
    }

    private function registerFormMacros() {
        $app = $this->app;
        $app['form']->macro('judgeField', function ($name, $id, $max) use ($app) {
            $id = htmlentities($id);
            $fb = $this->app['form'];
            /** @var $fb \Illuminate\Html\FormBuilder */
            $old = $fb->old($id);
            $old = ($old === null) ? "0" : $old;
            $inputType = $fb->getSessionStore()->has("judge-use-num") ? 'number' : 'range';
            return '<div class="control-group"><label for="' . $id . '">' . $name . '</label> <output for="' . $id . '">(0/' . $max . ' points)</output>
                <div class="control"><input value="' . $old . '" type="' . $inputType . '" min="0" max="' . (int)$max . '" name="' . $id . '" id="' . $id . '"></div></div>';
        });
    }

    public function register() {
        $app = $this->app;

        // Interface bindings
        $app->bind('\TenJava\Notification\IrcNotifierInterface', '\TenJava\Notification\FlareBotIrcNotifier');
        $app->bind('\TenJava\Notification\IrcMessageBuilderInterface', '\TenJava\Notification\FlareBotMessageBuilder');
//        $app->bind('\TenJava\Authentication\EmailOptOutInterface', '\TenJava\Authentication\GitHubEmailOptOut');
        $app->bind('\TenJava\Security\HmacVerificationInterface', '\TenJava\Security\HmacVerification');
        $app->bind('\TenJava\Security\HmacCreationInterface', '\TenJava\Security\HmacCreation');
        $app->bind('\TenJava\UrlShortener\UrlShortenerInterface', '\TenJava\UrlShortener\GitIoUrlShortener');
        $app->bind('\TenJava\Tools\String\StringTruncatorInterface', '\TenJava\Tools\String\StringTruncator');
        $app->bind('\TenJava\Repository\RepositoryActionInterface', '\TenJava\Repository\EloquentRepositoryAction');
        $app->bind('\TenJava\CI\BuildTriggerInterface', '\TenJava\CI\JenkinsBuildTrigger');
        $app->bind('\TenJava\Time\ContestTimesInterface', '\TenJava\Time\ContestTimes');
        $app->bind('\TenJava\Repository\ParticipantCommitRepositoryInterface', '\TenJava\Repository\EloquentParticipantCommitRepository');
        $app->bind('\TenJava\CI\BuildCreationInterface', '\TenJava\CI\JenkinsBuildCreation');
        $app->bind('\TenJava\Repository\RepoWebhookInterface', '\TenJava\Repository\GitHubRepoWebhook');
        $app->bind('\TenJava\Contest\ParticipantRepositoryInterface', '\TenJava\Contest\EloquentParticipantRepository');
        $app->bind('\TenJava\Contest\TwitchRepositoryInterface', '\TenJava\Contest\EloquentTwitchRepository');
        $app->bind('\TenJava\Contest\JudgeClaimsInterface', '\TenJava\Contest\EloquentJudgeClaims');
        $app->bind('\TenJava\Authentication\UserImpersonationInterface', '\TenJava\Authentication\GitHubUserImpersonation');
        $app->bind('\TenJava\Repository\UserRepositoryInterface', '\TenJava\Repository\UserRepository');

        // Singletons
        $app->singleton('GlobalComposer', '\TenJava\Composers\GlobalComposer');

        // Error handlers
        /*$app->missing(function ($exception) use ($app) {
            return $app->make("\TenJava\Http\Controllers\ErrorController")->missing();
        });

        $app->error(function (UnauthorizedException $ignored) use ($app) {
            return $app->make('\TenJava\Http\Controllers\ErrorController')->unauthorized();
        });

        $app->error(function (FailedOauthException $exception) use ($app) {
            return $app->make('\TenJava\Http\Controllers\ErrorController')->oauth();
        });

        $app->down(function () {
            return View::make("errors.maintenance");
        });*/

        $this->registerCommands();
        //$this->registerHeaders();
    }

    private function registerCommands() {
        $this->commands([
            '\TenJava\Console\MailTestCommand',
            '\TenJava\Console\RepoCleanupCommand',
            '\TenJava\Console\TwitterUpdateCommand',
            '\TenJava\Console\UserDeleteCommand',
            '\TenJava\Console\MailReminderCommand',
            '\TenJava\Console\RepoWebhookCommand',
            '\TenJava\Console\JenkinsJobCommand',
            '\TenJava\Console\JenkinsJobTriggerCommand',
            '\TenJava\Console\TwitchCleanupCommand',
            '\TenJava\Console\TwitchPollCommand',
            '\TenJava\Console\MailInfoCommand',
            '\TenJava\Console\TimeAnnounceCommand',
            '\TenJava\Console\UserVerificationChecker',
            '\TenJava\Console\MailNewsCommand',
            '\TenJava\Console\MailAllParticipantsCommand'
        ]);
    }

}
