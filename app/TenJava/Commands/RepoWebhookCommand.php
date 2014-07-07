<?php
namespace TenJava\Commands;

use App;
use Config;
use Github\Api\Repository\Hooks;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use TenJava\Models\Application;
use TenJava\Repository\RepositoryActionInterface;
use TenJava\Repository\RepoWebhookInterface;

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
     * @var \TenJava\Repository\RepoWebhookInterface
     */
    private $webhooks;

    /**
     * Create a new command instance.
     *
     * @param \TenJava\Repository\RepoWebhookInterface $webhooks
     * @return \TenJava\Commands\RepoWebhookCommand
     */
    public function __construct(RepoWebhookInterface $webhooks) {
        parent::__construct();
        $this->webhooks = $webhooks;
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
                    if ($this->option('update')) {
                        $this->info("Updating webhook for " . $repoName);
                        $this->webhooks->updateWebhook($repoName);
                    } else {
                        $this->info("Skipping " . $repoName . " it's done!");
                    }
                    continue;
                }
                $this->info("Creating webhook for " . $repoName);
                $this->webhooks->addWebhook($repoName);
                $this->info("Adding action to list...");
                $toFinalize[] = $repoName;
            }
        }
        $actionInterface->setMultipleReposActionComplete($toFinalize, "webhook");
    }


    public function getOptions() {
        return array(array("update", "upd", InputOption::VALUE_NONE, "update mode"));
    }

}
