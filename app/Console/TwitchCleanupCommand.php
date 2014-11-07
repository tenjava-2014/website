<?php namespace TenJava\Console;

use App;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;

class TwitchCleanupCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:twitchcleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans up non-existent twitch usernames.';

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Console\TwitchCleanupCommand
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
        /** @var \TenJava\Repository\RepositoryActionInterface $repoAction */
        $repoAction = App::make('\TenJava\Repository\RepositoryActionInterface'); //abuse it
        $done = $repoAction->getReposForAction('twitch_cleanup');
        $list = Application::where('judge', false)->get();
        $toFinalize = [];
        foreach ($list as $item) {
            /** @var Application $item */
            $name = $item->twitch_username;
            $this->info('Got username of ' . $name);
            if ($name === 'USER_REJECTED' || $name === null || in_array($item->gh_id, $done)) {
                $this->info('Skipping user due to rejection...');
                continue;
            }

            $client = new GuzzleClient();
            try {
                $client->get('https://api.twitch.tv/kraken/channels/' . $name);
                $this->info('Twitch channel is there!');
            } catch (ClientException $e) { // we should get a 422
                $this->comment("Twitch lookup failed so let's make them not have a Twitch username...");
                $item->twitch_username = 'USER_REJECTED';
                $item->save();
            }

            $toFinalize[] = $item->gh_id;
        }
        $repoAction->setMultipleReposActionComplete($toFinalize, 'twitch_cleanup');
    }

}
