<?php namespace TenJava\Console;

use Illuminate\Console\Command;
use Illuminate\Mail\Message;
use Mail;

class MailTestCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:mailtest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send jkcclemens mail';

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Console\MailTestCommand
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
        Mail::send('emails.welcome', array(), function (Message $message) {
            $message->to('woo@lol768.com', 'Some Name')->subject('Welcome!');
        });
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
