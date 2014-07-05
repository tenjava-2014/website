<?php
namespace TenJava\Commands;


use App;
use DateTime;
use DB;
use Guzzle\Http\Exception\RequestException;
use Guzzle\Http\Message\Request;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\ResponseInterface;
use Illuminate\Console\Command;
use TenJava\Models\Application;


class TwitchPollCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:twitchpoll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Polls for active twitch users.';

    /**
     * Create a new command instance.
     *
     * @return \TenJava\Commands\TwitchPollCommand
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
        $list = Application::with('timeEntry')->has("timeEntry", ">", "0")->where('judge', false)->get();
        $toFinalize = [];
        $appIds = [];
        $requests = [];
        $client = new GuzzleClient();
        foreach ($list as $item) {
            /** @var Application $item */
            $name = $item->twitch_username;
            $this->info("Got username of " . $name);
            if ($name === "USER_REJECTED" || $name === null) {
                $this->info("Skipping user due to rejection...");
                continue;
            }

            $requests[] = $client->createRequest("GET", "https://api.twitch.tv/kraken/streams/" . $name);
            $appIds[] = ['id' => $item->id, 'name' => $name];
            $this->info("Staged req for " . $name);


        }
        $this->comment("Sending batch...");
        $results = \GuzzleHttp\batch($client, $requests);


        foreach ($results as $i => $request) {
            // Get the result (either a ResponseInterface or RequestException)
            $result = $results[$request];
            if ($result instanceof ResponseInterface) {
                // Interact with the response directly
                $res = $result->json();
                if ($res['stream'] != null) {
                    $streamData = ["created_at" => new DateTime, "updated_at" => new DateTime, "app_id" => $appIds[$i]['id'], "preview_template" => "http://static-cdn.jtvnw.net/previews-ttv/live_user_" . $appIds[$i]['name'] . "-{WIDTH}x{HEIGHT}.jpg"];
                    $toFinalize[] = $streamData;
                    $this->info("Twitch channel is there and online! " . json_encode($streamData));
                } else {
                    $this->comment("Twitch channel offline!");
                }
            } else {
                // Get the exception message
                /** @var $request Request */
                /** @var $result RequestException */
                $this->error("A request to " . $request->getUrl() . " failed.");
                $this->error("We got a code of " . $result->getMessage());
            }
        }
        // This is more efficient than using Eloquent.
        if (count($toFinalize) != 0) {
            DB::table("online_streams")->insert($toFinalize);
        }
    }

}
