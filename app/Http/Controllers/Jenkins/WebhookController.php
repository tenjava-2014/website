<?php
namespace TenJava\Http\Controllers\Jenkins;

use Config;
use DB;
use Input;
use Lang;
use Log;
use Request;
use Response;
use TenJava\Http\Controllers\Abstracts\BaseController;
use TenJava\Models\Application;
use TenJava\Models\ParticipantAvatar;
use TenJava\Notification\IrcMessageBuilderInterface;
use TenJava\Notification\IrcNotifierInterface;
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
        Log::info("Got webhook req. from $ip, expecting " . Config::get('webhooks.jenkins'));
        if ($ip !== Config::get('webhooks.jenkins')) {
            Log::info('Rejecting webhook!');
            return Response::json('Invalid origin IP.');
        }

        $job = Input::get('name');
        $status = Input::get('build.status');
        $buildUrl = str_replace('http://thor.tenjava.com:8080', 'http://ci.tenjava.com', Input::get('build.full_url'));
        if ($status === 'FAILURE') {
            $message = $this->messageBuilder->insertBold()->insertNavyBlue()->insertText('[CI Build] ')->insertBold()->insertReset()->insertSecureText($job)->insertText(' finished with status ')->insertRed()->insertSecureText($status)->insertReset()->insertText(' - ' . $buildUrl);
        } else if ($status === 'SUCCESS') {
            $message = $this->messageBuilder->insertBold()->insertNavyBlue()->insertText('[CI Build] ')->insertBold()->insertReset()->insertMungedText($job)->insertText(' finished with status ')->insertGreen()->insertSecureText($status);
        } else {
            $message = $this->messageBuilder->insertBold()->insertNavyBlue()->insertText('[CI Build] ')->insertBold()->insertReset()->insertMungedText($job)->insertText(' finished with status ')->insertSecureText($status)->insertReset()->insertText(' - ' . $buildUrl);
        }

        $this->irc->sendMessage('#ten.commits', $message);
        return Response::json('OK');
    }


}
