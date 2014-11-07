<?php namespace TenJava\Console;

use App;
use Config;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use TenJava\CI\BuildCreationInterface;
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
     * @var \TenJava\CI\BuildCreationInterface
     */
    private $builds;

    /**
     * Create a new command instance.
     *
     * @param \TenJava\CI\BuildCreationInterface $builds
     * @return \TenJava\Console\JenkinsJobCommand
     */
    public function __construct(BuildCreationInterface $builds) {
        parent::__construct();
        $this->builds = $builds;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {

        /** @var \TenJava\Repository\EloquentRepositoryAction $repoAction */
        $repoAction = App::make('\TenJava\Repository\RepositoryActionInterface');
        $done = $repoAction->getReposForAction('jenkins');
        $list = Application::with('timeEntry')->has('timeEntry', '>', '0')->where('judge', false)->get();
        $this->comment('List has ' . $list->count() . ' items');
        foreach ($list as $entry) {
            /** @var \TenJava\Models\Application $entry */
            $this->handleEntry($entry, $repoAction, $done);
        }
    }

    private function handleEntry(Application $app, RepositoryActionInterface $actionInterface, $completed) {
        $times = $app->timeEntry;
        $possibleValues = [
            't1',
            't2',
            't3'
        ];
        $toFinalize = [];
        foreach ($possibleValues as $toCheck) {
            $this->comment('Checking ' . $toCheck . ' for ' . $app->gh_username);
            if ($times->$toCheck) {
                $this->info('Hit! ' . $toCheck);

                $repoName = $app->gh_username . '-' . $toCheck;
                if (in_array($repoName, $completed)) {
                    $this->info('Skip! ' . $toCheck);
                    continue;
                }
                $this->builds->createJob($repoName);
                $this->info('Adding action to list...');
                $toFinalize[] = $repoName;
            }
        }
        $actionInterface->setMultipleReposActionComplete($toFinalize, 'jenkins');
    }


}
