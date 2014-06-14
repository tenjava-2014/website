<?php
namespace TenJava\Controllers\Commit;

use Request;
use Config;
use Input;
use Response;
use TenJava\Controllers\Abstracts\BaseController;

use TenJava\Security\HmacVerificationInterface;

class WebhookController extends BaseController {

    public function __construct(HmacVerificationInterface $hmac) {
        $this->hmac = $hmac;
    }

    public function processGitHubWebhook() {
        $header = Request::header("X-Hub-Signature");
        parse_str($header, $output);
        $header = (array_key_exists("sha1", $output)) ? $output['sha1'] : null;

        if (!$this->hmac->verifySignature(Input::instance()->getContent(), $header, Config::get("webhooks.secret"))) {
            return Response::json("Invalid HMAC signature.");
        } else {
            return Response::json("OK");
        }
    }

}