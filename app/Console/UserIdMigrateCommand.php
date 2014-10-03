<?php namespace TenJava\Console;

use Config;
use Github\Client;
use Illuminate\Console\Command;
use TenJava\Models\Application;

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
     * @return \TenJava\Console\UserIdMigrateCommand
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
        /** $entry @var Application */
        foreach ($list as $entry) {
            if ($entry->gh_id === 0) {
                $user = $apiClient->show($entry->gh_username);
                if ($entry !== null) {
                    $this->comment("Got id of " . $user['id'] . " for " . $user['login']);
                    $entry->gh_id = $user['id'];
                    $entry->save();
                    $this->info("Updated id for " . $user['login']);
                } else {
                    $this->info("Missing GitHub API user info for " . $entry->gh_username);
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
        $client = new Client();
        $client->authenticate("tenjava", Config::get("gh-data.pass"), Client::AUTH_HTTP_PASSWORD);
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
