<?php
namespace TenJava\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use TenJava\Models\Application;

class UserDeleteCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:deleteapp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes user application entry..';

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Commands\UserDeleteCommand
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
        $app = Application::where("gh_username", $this->argument("name"))->first();
        if ($app == null) {
            $this->error("No such application.");
        } else {
            if ($this->confirm('Are you ABSOLUTELY sure?')) {
                $app->delete();
                $this->info("Application entry deleted.");
            }
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return array(
            array(
                "name",
                InputArgument::REQUIRED,
                "The user's GitHub username.",
                null
            ));
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
