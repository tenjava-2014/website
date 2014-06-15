<?php
namespace TenJava\Controllers\Commit;

use Request;
use Config;
use Input;
use Response;
use TenJava\Controllers\Abstracts\BaseController;

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

    public function processGitHubWebhook() {
        $header = Request::header("X-Hub-Signature");
        parse_str($header, $output);
        $header = (array_key_exists("sha1", $output)) ? $output['sha1'] : null;

        if (!$this->hmac->verifySignature(Input::instance()->getContent(), $header, Config::get("webhooks.secret"))) {
            return Response::json("Invalid HMAC signature.");
        } else {
            $author = Input::get("head_commit.author.username");
            $commitMessage = Input::get("head_commit.message");
            $repoName = Input::get("repository.name");
            $repoNameTime = substr($repoName, -2);
            $notificationHeading = "[Commit";
            switch($repoNameTime) {
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
            $message = $this->messageBuilder->
                insertBold()->insertNavyBlue()->insertText($notificationHeading)->insertBold()->
                insertReset()->insertText(" ")->insertMungedText($author)->insertText(": ")->
                insertSecureText($this->trunc->truncateString($commitMessage, 50))->insertText(" - " . $shortUrl);
            $this->irc->sendMessage("#ten.java", $message);
            return Response::json("OK");
        }
    }

}