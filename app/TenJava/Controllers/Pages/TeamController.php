<?php
namespace TenJava\Controllers\Pages;

use Config;
use Response;
use TenJava\Controllers\Abstracts\BaseController;
use TenJava\Models\Judge;

class TeamController extends BaseController {

    public function showTeam() {
        $this->setPageTitle("Meet the team");
        $this->setActive("team");
        $teamMembers = array();
        $teamMembers['Organizers'] = Judge::where("admin", true)->lists("github_name");
        $teamMembers['Web Team'] = Judge::where("web_team", true)->lists("github_name");
        $teamMembers['Judges'] = Judge::lists("github_name");
        $teamMembers['Sponsors'] = Config::get("user-access.present.Sponsors");
        return Response::view('pages.static.judges', array("teamMembers" => $teamMembers));
    }

    public function showJudgingStats() {
        $this->setPageTitle("Judging stats");
        $this->setActive("judging stats");
        $viewData['judges'] = Judge::lists("github_name");
        return Response::view('pages.dynamic.judging_stats', $viewData);
    }

} 