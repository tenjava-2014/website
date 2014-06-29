<?php
namespace TenJava\Commands;

use Config;
use Github\Api\Repository\Hooks;
use Illuminate\Console\Command;
use TenJava\Models\Application;
use TenJava\Models\Judge;

class AuthCleanupCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:authmigrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrates config-based auth to MySQL.';

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Commands\AuthCleanupCommand
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
        $staff = Config::get("user-access.staff");
        $admins = Config::get("user-access.admins");
        foreach ($staff as $id => $name) {
            $judge = new Judge;
            $judge->admin = false;
            $judge->github_name = $name;
            $judge->github_id = $id;
            $judge->save();
            $this->info("Saved " . $name);
        }
        foreach ($admins as $id => $name) {
            $judge = new Judge;
            $judge->admin = true;
            $judge->github_name = $name;
            $judge->github_id = $id;
            $judge->save();
            $this->info("Saved " . $name);
        }
    }
}
