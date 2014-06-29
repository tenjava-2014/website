<?php
namespace TenJava\Controllers\Commit;

use DateTime;
use DB;
use Lang;
use Request;
use Config;
use Input;
use Response;
use TenJava\Controllers\Abstracts\BaseController;

use TenJava\Models\Application;
use TenJava\Models\ParticipantAvatar;
use TenJava\Notification\IrcMessageBuilderInterface;
use TenJava\Notification\IrcNotifierInterface;
use TenJava\Security\HmacVerificationInterface;
use TenJava\Tools\String\StringTruncatorInterface;
use TenJava\UrlShortener\UrlShortenerInterface;

class WebhookController extends BaseController {

    /**
     * @var \TenJava\Notification\IrcNotifierInterface
     */
    private $irc;
    /**
     * @var \TenJava\Security\HmacVerificationInterface
     */
    private $hmac;
    /**
     * @var \TenJava\Notification\IrcMessageBuilderInterface
     */
    private $messageBuilder;
    /**
     * @var \TenJava\Tools\String\StringTruncatorInterface
     */
    private $trunc;
    /**
     * @var \TenJava\UrlShortener\UrlShortenerInterface
     */
    private $short;

    public function __construct(HmacVerificationInterface $hmac, IrcNotifierInterface $irc, IrcMessageBuilderInterface $messageBuilder, StringTruncatorInterface $trunc, UrlShortenerInterface $short) {
        $this->irc = $irc;
        $this->hmac = $hmac;
        $this->messageBuilder = $messageBuilder;
        $this->trunc = $trunc;
        $this->short = $short;
    }

    private function verifyHmac() {
        $header = Request::header("X-Hub-Signature");
        parse_str($header, $output);
        $header = (array_key_exists("sha1", $output)) ? $output['sha1'] : null;
        return $this->hmac->verifySignature(Input::instance()->getContent(), $header, Config::get("webhooks.secret"));
    }

    public function processGitHubWebhook() {
        if (!$this->verifyHmac()) {
            return Response::json("Invalid HMAC sig.");
        }

        $hookType = Request::header("X-GitHub-Event");
        if ($hookType === "pull_request") {
            return $this->handlePr();
        } else if ($hookType !== "push") {
            return Response::json("Invalid event type.");
        }

        $author = Input::get("head_commit.author.username");
        $commitMessage = Input::get("head_commit.message");
        $repoName = Input::get("repository.name");
        $repoNameTime = substr($repoName, -2);
        $notificationHeading = "[Commit";
        switch ($repoNameTime) {
            case "t1":
                $notificationHeading .= "/1]";
                break;
            case "t2":
                $notificationHeading .= "/2]";
                break;
            case "t3":
                $notificationHeading .= "/3]";
                break;
            default:
                $notificationHeading .= "/" . $repoName . "]";
                break;
        }
        $shortUrl = $this->short->shortenUrl(Input::get("head_commit.url"), "tenjava-" . substr(Input::get("head_commit.id"), 0, 10));
        $commitMsg = $this->trunc->truncateString($commitMessage, 50);
        $message = $this->messageBuilder->
            insertBold()->insertNavyBlue()->insertText($notificationHeading)->insertBold()->
            insertReset()->insertText(" ")->insertMungedText($author)->insertText(": ")->
            insertSecureText($commitMsg)->insertText(" - " . $shortUrl);
        $this->irc->sendMessage("#ten.java", $message);

        $authorApp = Application::where("gh_username", $author)->first();
        if ($author !== null) {
            // We have the app entry, now let's see if the avatar exists
            $this->addAvatar($authorApp);
            // Now it's time to insert this commit data into our table!
            $this->addCommitEntry($authorApp, Input::get("commits"), Input::get("repository.name"));
        }
        return Response::json("OK");
    }

    private function addAvatar(Application $application) {
        $existingAvatar = ParticipantAvatar::where("app_id", $application->id)->first();
        if ($existingAvatar === null) {
            // Let's insert the avatar
            $newAvatar = new ParticipantAvatar();
            $newAvatar->app_id = $application->id;
            $client = $this->getUserApiClient();
            $userData = $client->show($application->gh_username);
            if (array_key_exists("avatar_url", $userData)) {
                $avatarUrl = $userData['avatar_url'];
                $newAvatar->url = $avatarUrl;
                $newAvatar->save();
            }
        }
    }

    private function addCommitEntry(Application $application, $commits, $repoName) {
        /* Wondering why I'm not using the Eloquent model here and I'm inserting it all manually?
           See https://github.com/laravel/framework/issues/1295#issuecomment-21743294 */
        $commitEntries = [];
        foreach ($commits as $commit) {
            $entry = [
                "created_at" => new DateTime($commit['timestamp']),
                "updated_at" => new DateTime($commit['timestamp']),
                "hash" => $commit['id'],
                "message" => $this->trunc->truncateString($commit['message'], 50),
                "repo" => $repoName
            ];
            $commitEntries[] = $entry;
        }
        DB::table("participant_commits")->insert($commitEntries);
    }

    private function handlePr() {
        /* Display scary warning to repo owner */
        $client = $this->getIssuesApiClient();
        $prClient = $this->getPrApiClient();
        if (Input::get("action") === "opened") {
            $params = ["body" => Lang::get("judging.pr-warning")];
            $client->comments()->create("tenjava", Input::get("repository.name"), Input::get("number"), $params);
            $prClient->update("tenjava", Input::get("repository.name"), Input::get("number"), ["state" => "closed"]);
        } else if (Input::get("action") === "reopened") {
            $params = ["body" => Lang::get("judging.pr-warning-2")];
            $client->comments()->create("tenjava", Input::get("repository.name"), Input::get("number"), $params);
            $prClient->update("tenjava", Input::get("repository.name"), Input::get("number"), ["state" => "closed"]);
        }
        return Response::json("Handled it, thanks!");
    }

}