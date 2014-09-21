<?php
namespace TenJava\Commands;

use Illuminate\Console\Command;
use Mail;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use TenJava\Models\Subscription;

class MailNewsCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:mailnews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the given email template to subscribed users.';

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Commands\MailNewsCommand
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
        $template = $this->argument('template');
        $test = $this->option('test');
        $recipients = $test ? [Subscription::where('gh_username', 'jkcclemens')->first()] : Subscription::all();
        if (!$this->confirm('Send template ' . $template . ' (test: ' . $test . ') to ' . count($recipients) . ' people?', false)) {
            return;
        };
        /*Mail::send($template, array(), function ($message) {
            $message->to('woo@lol768.com', 'Some Name')->subject('Welcome!');
        });*/
        $this->info("Would've sent.");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return array(
            ['template', InputArgument::REQUIRED, 'Template to send']
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return array(
            ['test', null, InputOption::VALUE_NONE, 'Send the email to jkcclemens instead']
        );
    }

}
