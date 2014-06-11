<?php


use TenJava\Security\HmacVerificationInterface;

class WebhookController extends BaseController {

    public function __construct(HmacVerificationInterface $hmac) {
        $this->hmac = $hmac;
    }

    public function processGitHubWebhook() {
        $header = Request::header("X-Hub-Signature");
        parse_str($header, $output);
        $header = $output['sha1'];

        if (!$this->hmac->verifySignature(Input::instance()->getContent(), $header, Config::get("webhooks.secret"))) {
            return Response::json("Invalid HMAC signature.");
        } else {
            return Response::json("OK");
        }
    }

}