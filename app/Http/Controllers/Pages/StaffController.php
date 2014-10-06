<?php
namespace TenJava\Http\Controllers\Pages;

use Config;
use Response;
use TenJava\Http\Controllers\Abstracts\BaseController;
use TenJava\Repository\UserRepositoryInterface;
use TenJava\Staff;

class StaffController extends BaseController {

    public function showJudgingStats() {
        $this->setPageTitle('Judging stats');
        $this->setActive('judging stats');
        $viewData['judges'] = $judges = Staff::judge()->with('claims')->get();
        $viewData['total_progress'] = ['total_claims' => 0, 'completed_claims' => 0];
        $viewData['judge_progress'] = [];
        foreach ($judges as $judge) {
            /**
             * @var $judge Staff
             */
            $viewData['judge_progress'][$judge->username] = ['completed' => 0, 'assigned' => 0];
            foreach ($judge->claims as $claim) {
                $viewData['total_progress']['total_claims'] += 1;
                $this->incrementJudgeAssigned($viewData['judge_progress'], $judge->username);
                if ($claim->result != null) {
                    $viewData['total_progress']['completed_claims'] += 1;
                    $this->incrementJudgeCompleted($viewData['judge_progress'], $judge->username);
                }
            }
        }

        foreach ($viewData['judge_progress'] as &$entry) {
            $entry['finished'] = ($entry['completed'] == $entry['assigned']);
            $entry['percent'] = (int)($entry['assigned'] == 0) ? 100 : (floatval($entry['completed']) / $entry['assigned']) * 100;
        }

        $viewData['total_progress']['finished'] = ($viewData['total_progress']['completed_claims'] == $viewData['total_progress']['total_claims']);
        $viewData['total_progress']['percent'] = ($viewData['total_progress']['total_claims'] == 0) ? 100 : (floatval($viewData['total_progress']['completed_claims']) / $viewData['total_progress']['total_claims']) * 100;
        $viewData['total_progress']['percent'] = (int)$viewData['total_progress']['percent'];
        $viewData['judges'] = $judges;
        return Response::view('pages.dynamic.judging_stats', $viewData);
    }

    private function incrementJudgeAssigned(&$array, $judge) {
        $array = $this->incrementJudgeStat($array, $judge, 'assigned');
    }

    private function incrementJudgeStat(&$array, $judge, $type) {
        $array[$judge][$type] += 1;
        return $array;
    }

    private function incrementJudgeCompleted(&$array, $judge) {
        $array = $this->incrementJudgeStat($array, $judge, 'completed');
    }

    public function showTeam(UserRepositoryInterface $userRepository) {
        $this->setPageTitle('Meet the staff');
        $this->setActive('staff');
        return Response::view('pages.static.staff', ["staffMembers" => $userRepository->getStaffMembers()]);
    }
}
