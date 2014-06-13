<?php
namespace TenJava\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MailTestCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'mailt:test';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Send lol768 mail';

    /**
     * Create a new command instance.
     *
     * @return \MailTestCommand
     */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        Mail::send('emails.welcome', array(), function($message)
        {
            $message->to('woo@lol768.com', 'Some Name')->subject('Welcome!');
        });
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array();
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array();
	}

}
