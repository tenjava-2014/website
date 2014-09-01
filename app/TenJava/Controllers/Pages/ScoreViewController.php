<?php
namespace TenJava\Controllers\Pages;

use Illuminate\Filesystem\Filesystem;
use TenJava\Controllers\Abstracts\BaseController;
use Response;
use TenJava\Models\Application;

class ScoreViewController extends BaseController {

    public function showScores() {
        $this->setPageTitle("Your entry scores");
        $app = $this->getApplication();
        if ($app == null) {
            return Response::view('errors.noapp');
        }
        $timeEntry = $app->timeEntry;

        return Response::view('pages.dynamic.own-scores',
                              ["app" => $app, "times" => $timeEntry->getApplicableTimes($app->gh_username),
                               "data" => $this->getResultsInfo()]);
    }

    /**
     * @return Application
     */
    private function getApplication() {
        // Quite honestly, the entire authentication system is a mystery
        // I have no clue how it works anymore and it needs redoing one day
        $githubName = $this->auth->getUsername();
        $app = Application::where("gh_username", $githubName)->first();

        return $app;
    }

    private function getResultsInfo() {
        $fs = new Filesystem();
        $path = storage_path() . "/secure/results.json";
        if ($fs->exists($path)) {
            return json_decode($fs->get($path), true);
        } else {
            die("Oops! Looks like the results file isn't here..");
        }
    }

} 