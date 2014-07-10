<?php
namespace TenJava\Commands;

use Illuminate\Console\Command;
use Mail;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use TenJava\Models\Application;
use TenJava\Models\ParticipantTimes;

class MailInfoCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:finalmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send final mail to people.';

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Commands\MailInfoCommand
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
            /** @var $app Application */
            $this->info("Checking " . $app->gh_username);
            $timeEntry = $app->timeEntry;
            /** @var $timeEntry ParticipantTimes */
            $this->comment("No time entry!");
            $emails = json_decode($app->github_email, true);
            if (array_key_exists("fail", $emails)) {
                $this->error($app->gh_username . " has no email entry (user declined). Contact DBO: " . $app->dbo_username);
                continue;
            } else if (array_key_exists("others", $emails)) {
                $emails = $emails['others'];
            }
            $chosenEmail = null;
            foreach ($emails as $email) {
                if (str_contains($email, "users.noreply")) {
                    continue;
                } else {
                    $chosenEmail = $email;
                    break;
                }
            }
            if ($chosenEmail === null) {
                $this->error($app->gh_username . " has no email entry (none available). Contact DBO: " . $app->dbo_username);
            } else {
                $this->comment("Chosen email is " . $chosenEmail);
                $data = ["t1" => false, "t2" => false, "t3" => false];
                if ($timeEntry != null) {
                    $data = $timeEntry->toArray();
                }
                $this->info(json_encode($data));
                Mail::send(array('text' => 'emails.final-info'), $data, function ($message) use ($chosenEmail) {
                    $message->from('tenjava@tenjava.com', 'ten.java Team');
                    $message->to($chosenEmail)->subject('ten.java time selection required');
                });
                $this->comment("Email sent!");
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
