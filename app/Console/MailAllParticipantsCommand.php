<?php namespace TenJava\Console;

use Illuminate\Console\Command;
use Illuminate\Mail\Message;
use Mail;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use TenJava\Models\Application;
use TenJava\QueueJobs\SendMailJob;

class MailAllParticipantsCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:mailall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to all participants (those who applied).';

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Console\MailAllParticipantsCommand
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
        $apps = $this->option('test') ? [Application::where('gh_username', 'jkcclemens')->first()] : Application::where("judge", false)->get();
        if (!$this->confirm('Send email to ' . count($apps) . ' people?')) {
            return;
        }
        foreach ($apps as $app) {
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
                $this->info("Queueing email to " . $chosenEmail . ".");
                Mail::queue('emails.last-email', ['name' => $app->gh_username], function (Message $message) use ($chosenEmail, $app) {
                    $message->from('no-reply@tenjava.com', 'The ten.java Team');
                    $message->to($chosenEmail, $app->gh_username)->subject('ten.java News Updates');
                });
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
        return array(
            ['test', null, InputOption::VALUE_NONE, 'Send the email to jkcclemens instead'],
        );
    }

}
