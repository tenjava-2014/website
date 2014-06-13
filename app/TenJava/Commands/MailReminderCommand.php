<?php
namespace TenJava\Commands;

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
     * @return \TenJava\Commands\MailReminderCommand
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
            $timeEntry = $app->timeEntry()->first();
            if ($timeEntry === null) {
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
                    Mail::queue(array('text' => 'emails.time-remind'), array("user" => $app->gh_username), function ($message) use ($chosenEmail) {
                        $message->from('tenjava@tenjava.com', 'ten.java Team');
                        $message->to($chosenEmail)->subject('ten.java time selection required');
                    });
                    $this->comment("Email sent!");
                }
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
