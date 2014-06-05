<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MailReminderCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:remindmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to people who have not confirmed their times.';

    /**
     * Create a new command instance.
     *
     * @return \MailReminderCommand
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
        $apps = Application::where("judge", false)->get();
        foreach ($apps as $app) {
            $this->info("Checking " . $app->gh_username);
            $timeEntry = $app->timeEntry();
            if ($timeEntry === null) {
                $this->info("No time entry!");
            } else {
                $this->info("Valid time entry.");
            }

        }

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
