<?php namespace TenJava\Console;

use Config;
use Github\Api\Repository\Hooks;
use Illuminate\Console\Command;
use TenJava\Models\Application;
use TenJava\Models\Judge;

class JudgeNagCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:judgenag';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gives a daily summary of remaining submission stats.';

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Console\JudgeNagCommand
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

    }
}
