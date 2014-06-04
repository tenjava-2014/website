<?php


class TeamController extends BaseController {

    public function showTeam() {
        $this->setPageTitle("Meet the team");
        $this->setActive("team");
        return Response::view('pages.static.judges', array());
    }

} 