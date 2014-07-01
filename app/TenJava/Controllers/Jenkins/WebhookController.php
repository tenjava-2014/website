<?php
namespace TenJava\Controllers\Jenkins;

use DateTime;
use DB;
use Lang;
use Log;
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

    public function __construct(IrcNotifierInterface $irc, IrcMessageBuilderInterface $messageBuilder, StringTruncatorInterface $trunc, UrlShortenerInterface $short) {
        $this->irc = $irc;
        $this->messageBuilder = $messageBuilder;
        $this->trunc = $trunc;
        $this->short = $short;
    }

    public function processWebhook() {
        $ip = Request::getClientIp();
        Log::info("Got webhook req. from $ip, expecting " . Config::get("webhooks.jenkins"));
        if ($ip !== Config::get("webhooks.jenkins")) {
            Log::info("Rejecting webhook!");
            return Response::json("Invalid origin IP.");
        }

        $job = Input::get("name");
        $status = Input::get("build.status");
        if ($status === "FAILURE") {
            $message = $this->messageBuilder->insertBold()->insertText("CI Build: ")->insertBold()->insertSecureText($job)->insertText(" finished with status ")->insertRed()->insertSecureText($status);
        } else if ($status === "SUCCESS") {
            $message = $this->messageBuilder->insertBold()->insertText("CI Build: ")->insertBold()->insertMungedText($job)->insertText(" finished with status ")->insertGreen()->insertSecureText($status);
        } else {
            $message = $this->messageBuilder->insertBold()->insertText("CI Build: ")->insertBold()->insertMungedText($job)->insertText(" finished with status ")->insertSecureText($status);
        }

        $this->irc->sendMessage("#ten.java", $message);
        return Response::json("OK");
    }


}