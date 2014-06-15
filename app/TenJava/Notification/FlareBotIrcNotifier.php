<?php
namespace TenJava\Notification;

use GuzzleHttp\Client as GuzzleClient;
use Config;

class FlareBotIrcNotifier implements IrcNotifierInterface {

    /**
     * @param string $channel The channel name, with a leading #.
     * @param string|\TenJava\Notification\IrcMessageBuilderInterface $message The message.
     * @return void
     */
    public function sendMessage($channel, IrcMessageBuilderInterface $message) {
        $client = new GuzzleClient();
        $url = Config::get("flarebot.base");
        die("the message was " . $message->getText());
        $client->get($url, ['query' => ['key' => Config::get("flarebot.secret"), 'target' => $channel, 'no_format' => true, 'message' => $message->getText()]]);
    }
}