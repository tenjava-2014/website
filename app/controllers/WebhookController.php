<?php


use Security\HmacVerificationInterface;

class WebhookController extends BaseController {

    public function __construct(HmacVerificationInterface $hmac) {
        $this->hmac = $hmac;
    }

    public function processGitHubWebhook() {
        if (!$this->hmac->verifySignature(Input::instance()->getContent(), Request::header("X-Hub-Signature"), Config::get("webhooks.secret"))) {
            return Response::json("Invalid HMAC signature.");
        } else {
            return Response::json("OK");
        }
    }

}