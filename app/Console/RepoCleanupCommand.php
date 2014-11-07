<?php namespace TenJava\Console;

use Config;
use Illuminate\Console\Command;

class RepoCleanupCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:repocleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes all participant repo in preparation for time info.';

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Console\RepoCleanupCommand
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
        $list = Application::where('judge', false)->get();
        $apiClient = $this->getApiClient();
        foreach ($list as $entry) {
            $this->comment('Deleting ' . $entry->gh_username);
            $apiClient->remove('tenjava', $entry->gh_username);
            $this->info('Removed ' . $entry->gh_username . '!');
        }
    }

    /**
     * @return \Github\Api\Repo
     */
    private function getApiClient() {
        $client = new \Github\Client();
        $client->authenticate('tenjava', Config::get('gh-data.pass'), \Github\Client::AUTH_HTTP_PASSWORD);
        return $client->api('repo');
    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return [];
    }

}
