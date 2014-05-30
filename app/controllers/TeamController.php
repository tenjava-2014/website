<?php


class TeamController extends BaseController {

    public function showTeam() {
        $this->setPageTitle("Judges");
        $this->setActive("judges");
        return Response::view('pages.static.judges', array(), 401);
    }

} 