<?php
namespace TenJava\Commands;

use Config;
use Github\Api\Repository\Hooks;
use Illuminate\Console\Command;
use TenJava\Models\Application;
use TenJava\Models\Judge;
use TenJava\Security\HmacCreationInterface;

class UserVerificationChecker extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:user-verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifies a user-provided verification key.';
    /**
     * @var HmacCreationInterface
     */
    private $hmac;

    /**
     * Create a new command instance.
     *
     * @param HmacCreationInterface $hmac
     * @return \TenJava\Commands\UserVerificationChecker
     */
    public function __construct(HmacCreationInterface $hmac) {
        parent::__construct();
        $this->hmac = $hmac;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $githubName = $this->ask("Enter GitHub username:");
        $githubId = $this->ask("Enter GitHub ID:");
        $this->info($this->hmac->createSignature($githubId . "-" . $githubName, Config::get("gh-data.verification-key")));
    }
}
