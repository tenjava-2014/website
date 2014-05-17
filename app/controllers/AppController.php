<?php

class AppController extends BaseController {

    public function applyJudge() {
        return Redirect::to("/oauth/confirm")->with('intent', 'judge');
    }

    public function applyParticipant() {
        return Redirect::to("/oauth/confirm")->with('intent', 'participant');
    }

} 