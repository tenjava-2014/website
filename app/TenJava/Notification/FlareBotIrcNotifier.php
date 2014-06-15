<?php
namespace TenJava\Notification;

use GuzzleHttp\Client as GuzzleClient;
use Config;

class FlareBotIrcNotifier implements IrcNotifierInterface {

    /**
     * @param string $channel The channel name, with a leading #.
     * @param string $message The unencoded message.
     * @return void
     */
    public function sendMessage($channel, $message) {
        $client = new GuzzleClient();
        $url = Config::get("flarebot.base");
        $toRemove = ["\r", "\n", "\x02", "\x03"]; // No newlines, CRs or fomatting characters
        $message = str_replace($toRemove, "", $message);
        $client->get($url, ['query' => ['key' => Config::get("flarebot.secret"), 'target' => $channel, 'no_format' => true, 'message' => $message]]);
    }
}