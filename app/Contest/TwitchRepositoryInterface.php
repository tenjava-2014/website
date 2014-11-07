<?php namespace TenJava\Contest;

interface TwitchRepositoryInterface {

    public function getOnlineStreamers($max = null, $random = false);
}
