<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UserIdMigrateCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:migrateusers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds GH Ids to user table.';

    /**
     * Create a new command instance.
     *
     * @return \UserIdMigrateCommand
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
        $list = Application::all();
        $apiClient = $this->getApiClient();
        foreach ($list as $entry) {
            if ($entry->gh_id === 0) {
                $entry = $apiClient->find($entry->gh_username);
                if ($entry !== null) {
                    $this->info("Got id of " . $entry['id'] . " for " . $entry['username']);
                } else {
                    $this->info("Missing GitHub API user info for " . $entry['username']);
                }
            } else {
                $this->info("User already had an id, skipping " . $entry->gh_username);
            }
        }
    }

    /**
     * @return \Github\Api\User
     */
    private function getApiClient() {
        $client = new \Github\Client();
        $client->authenticate("tenjava", Config::get("gh-data.pass"), \GitHub\Client::AUTH_HTTP_PASSWORD);
        return $client->api('user');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return array();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return array();
    }

}
