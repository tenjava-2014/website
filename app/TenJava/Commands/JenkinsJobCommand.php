<?php
namespace TenJava\Commands;

use App;
use Config;
use Github\Api\Repository\Hooks;
use Guzzle\Service\Client;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use TenJava\Models\Application;
use TenJava\Repository\RepositoryActionInterface;

class JenkinsJobCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:jenkins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds jenkins jobs.';

    private $jobConfig;

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Commands\JenkinsJobCommand
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $this->jobConfig = (new Filesystem())->get(base_path() . '/../app_config/config.xml');
        /** @var \TenJava\Repository\EloquentRepositoryAction $repoAction */
        $repoAction = App::make("\\TenJava\\Repository\\RepositoryActionInterface");
        $done = $repoAction->getReposForAction("jenkins");
        $list = Application::with('timeEntry')->has("timeEntry", ">", "0")->where('judge', false)->get();
        $this->comment("List has " . $list->count() . " items");
        foreach ($list as $entry) {
            /** @var \TenJava\Models\Application $entry */
            $this->handleEntry($entry, $repoAction, $done);
        }
    }

    private function handleEntry(Application $app, RepositoryActionInterface $actionInterface, $completed) {
        $times = $app->timeEntry;
        $possibleValues = ['t1','t2','t3'];
        $toFinalize = [];
        foreach ($possibleValues as $toCheck) {
            $this->comment("Checking " . $toCheck . " for " . $app->gh_username);
            if ($times->$toCheck) {
                $this->info("Hit! " . $toCheck);

                $repoName = $app->gh_username . "-" . $toCheck;
                if (in_array($repoName, $completed)) {
                    $this->info("Skip! " . $toCheck);
                    continue;
                }

                $jobConfig = str_replace("%%REPO_NAME%%/", $repoName, $this->jobConfig);
                $this->info("Creating jenkins job for " . $repoName);
                $client = new Client();
                $resp = $client->post("http://ci.tenjava.com/createItem", ["auth" => ['tenjava', Config::get("webhooks.jenkins_token")], "headers" => ["Content-Type" => "application/xml"], "body" => $jobConfig]);
                $this->info($resp->getResponseBody());
                $this->info("Adding action to list...");
                $toFinalize[] = $repoName;
            }
        }
        $actionInterface->setMultipleReposActionComplete($toFinalize, "jenkins");
    }



}
