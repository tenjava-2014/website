<?php

class AppController extends BaseController {

    public function applyJudge() {
        Session::flash('intent', 'judge');
        return Redirect::to("/oauth/confirm");
    }

    public function applyParticipant() {
        Session::flash('intent', 'participant');
        return Redirect::to("/oauth/confirm");
    }

} 