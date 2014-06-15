<?php
namespace TenJava\Notification;

interface IrcNotifierInterface {
    /**
     * @param string $channel The channel name, with a leading #.
     * @param string $message The unencoded message.
     * @return void
     */
    public function sendMessage($channel, $message);
} 