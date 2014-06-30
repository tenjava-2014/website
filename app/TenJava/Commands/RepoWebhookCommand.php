<?php
namespace TenJava\Commands;

use App;
use Config;
use Github\Api\Repository\Hooks;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use TenJava\Models\Application;
use TenJava\Repository\RepositoryActionInterface;

class RepoWebhookCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:repohooks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds webhooks to repos.';

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Commands\RepoWebhookCommand
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
        /** @var \TenJava\Repository\EloquentRepositoryAction $repoAction */
        $repoAction = App::make("\\TenJava\\Repository\\RepositoryActionInterface");
        $done = $repoAction->getReposForAction("webhook");
        $list = Application::with('timeEntry')->has("timeEntry", ">", "0")->where('judge', false)->get();

        $this->comment("List has " . $list->count() . " items");
        $hooks = $this->getApiClient()->hooks();
        foreach ($list as $entry) {
            /** @var \TenJava\Models\Application $entry */
            $this->handleEntry($entry, $hooks, $repoAction, $done);
        }
    }

    private function handleEntry(Application $app, Hooks $hooks, RepositoryActionInterface $actionInterface, $completed) {
        $times = $app->timeEntry;
        $possibleValues = ['t1','t2','t3'];
        $toFinalize = [];
        foreach ($possibleValues as $toCheck) {
            $this->comment("Checking " . $toCheck . " for " . $app->gh_username);
            if ($times->$toCheck) {
                $this->info("Hit! " . $toCheck);

                $repoName = $app->gh_username . "-" . $toCheck;
                if (in_array($repoName, $completed)) {
                    if ($this->option('update')) {
                        $this->info("Updating webhook for " . $repoName . " with data " . json_encode($this->getHookData()));
                        //$hooks->update("tenjava", $repoName, $this->getHookData());
                    } else {
                        $this->info("Skipping " . $repoName . " it's done!");
                    }
                    continue;
                }
                $this->info("Creating webhook for " . $repoName . " with data " . json_encode($this->getHookData()));
                $hooks->create("tenjava", $repoName, $this->getHookData());
                $this->info("Adding action to list...");
                $toFinalize[] = $repoName;
            }
        }
        $actionInterface->setMultipleReposActionComplete($toFinalize, "webhook");
    }

    private function getHookData() {
        $dataArray = ['name' => 'web',
                      'events' => [
                          'push',
                          'pull_request'],
                      'active' => true];
        $dataArray['config'] = [
            'url' => url('/webhook/fire'),
            'content_type' => 'json',
            'secret' => Config::get("webhooks.secret")
        ];
        return $dataArray;
    }

    /**
     * @return \Github\Api\Repo
     */
    private function getApiClient() {
        $client = new \Github\Client();
        $client->authenticate("tenjava", Config::get("gh-data.pass"), \Github\Client::AUTH_HTTP_PASSWORD);
        return $client->api('repo');
    }

    public function getOptions() {
        return array(array("update", "upd", InputOption::VALUE_NONE, "update mode", false));
    }

}
