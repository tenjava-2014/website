<?php namespace TenJava\Console;

use Illuminate\Console\Command;
use Mail;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MailInfoCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:streammail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send stream mail to people.';

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Console\MailInfoCommand
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
        $apps = Application::where('judge', false)->get();
        foreach ($apps as $app) {
            /** @var $app Application */
            $this->info('Checking ' . $app->gh_username);
            $emails = json_decode($app->github_email, true);
            if (array_key_exists('fail', $emails)) {
                $this->error($app->gh_username . ' has no email entry (user declined). Contact DBO: ' . $app->dbo_username);
                continue;
            } else if (array_key_exists('others', $emails)) {
                $emails = $emails['others'];
            }
            $chosenEmail = null;
            foreach ($emails as $email) {
                if (str_contains($email, 'users.noreply')) {
                    continue;
                } else {
                    $chosenEmail = $email;
                    break;
                }
            }
            if ($chosenEmail === null) {
                $this->error($app->gh_username . ' has no email entry (none available). Contact DBO: ' . $app->dbo_username);
            } else {
                $this->comment('Chosen email is ' . $chosenEmail);
                Mail::queue(array('text' => 'emails.results'), array('user' => $app->gh_username), function ($message) use ($chosenEmail) {
                    $message->from('tenjava@tenjava.com', 'ten.java Team');
                    $message->to($chosenEmail)->subject('ten.java results');
                });
                $this->comment('Email sent!');
            }

        }

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return [];
    }

}
