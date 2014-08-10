<?php
namespace TenJava\Controllers\Pages;

use Config;
use Response;
use TenJava\Controllers\Abstracts\BaseController;
use TenJava\Models\Judge;
use TenJava\Models\JudgeClaim;

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

    private function incrementJudgeStat(&$array, $judge, $type) {
            $array[$type][$judge] += 1;
            return $array;
    }

    private function incrementJudgeAssigned(&$array, $judge) {
        $array = $this->incrementJudgeStat($array, $judge, "assigned");
    }

    private function incrementJudgeCompleted(&$array, $judge) {
        $array = $this->incrementJudgeStat($array, $judge, "completed");
    }

    public function showJudgingStats() {
        $this->setPageTitle("Judging stats");
        $this->setActive("judging stats");
        $viewData['judges'] = Judge::with("claims.result")->get();
        $judges = Judge::with("claims.result")->where("show_on_judge_page", true)->where("enabled", true)->get();
        $viewData['total_progress'] = ["total_claims" => 0, "completed_claims" => 0];
        $viewData['judge_progress'] = [];
        foreach ($judges as $judge) {
            /** @var $judge Judge */
            $viewData['judge_progress'][$judge->github_name] = ["completed" => 0, "assigned" => 0];
            foreach ($judge->claims as $claim) {
                /** @var $claim JudgeClaim */
                $viewData['total_progress']['total_claims'] += 1;
                $this->incrementJudgeAssigned($viewData['judge_progress'], $judge->github_name);
                if ($claim->result != null) {
                    $viewData['total_progress']['completed_claims'] += 1;
                    $this->incrementJudgeCompleted($viewData['judge_progress'], $judge->github_name);
                }
            }
        }

        foreach ($viewData['judge_progress'] as &$entry) {
            $entry['finished'] = ($entry['completed'] == $entry['assigned']);
            $entry['percent'] = (int)($entry['assigned'] == 0) ? 100 : (floatval($entry['completed']) / $entry['assigned']) * 100;
        }

        $viewData['total_progress']['finished'] = ($viewData['total_progress']['completed_claims'] == $viewData['total_progress']['total_claims']);
        $viewData['total_progress']['percent'] = (int) (floatval($viewData['total_progress']['completed_claims']) / $viewData['total_progress']['total_claims']) * 100;

        $viewData['judges'] = $judges;
        return Response::view('pages.dynamic.judging_stats', $viewData);
    }
}
