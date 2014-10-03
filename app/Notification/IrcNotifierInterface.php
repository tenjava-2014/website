<?php
namespace TenJava\Notification;

interface IrcNotifierInterface {

    /**
     * @param string $channel The channel name, with a leading #.
     * @param IrcMessageBuilderInterface $message The message.
     * @return void
     */
    public function sendMessage($channel, IrcMessageBuilderInterface $message);
} 