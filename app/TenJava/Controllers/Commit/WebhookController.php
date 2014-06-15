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

    public function __construct(HmacVerificationInterface $hmac, IrcNotifierInterface $irc, IrcMessageBuilderInterface $messageBuilder) {
        $this->irc = $irc;
        $this->hmac = $hmac;
        $this->messageBuilder = $messageBuilder;
    }

    public function processGitHubWebhook() {
        $header = Request::header("X-Hub-Signature");
        parse_str($header, $output);
        $header = (array_key_exists("sha1", $output)) ? $output['sha1'] : null;

        if (!$this->hmac->verifySignature(Input::instance()->getContent(), $header, Config::get("webhooks.secret"))) {
            return Response::json("Invalid HMAC signature.");
        } else {
            $author = Input::get("head_commit.committer.username");
            $this->irc->sendMessage("#ten.test", $this->messageBuilder->insertBold()->insertGreen()->insertText("We got a commit from ")->insertMungedText($author));
            return Response::json("OK");
        }
    }

}