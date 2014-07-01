<?php
namespace TenJava\CI;

use Config;
use GuzzleHttp\Client as GuzzleClient;

class JenkinsBuildTrigger implements BuildTriggerInterface {

    private $token;

    public function setToken($token) {
        $this->token = $token;
    }

    public function triggerBuild($name, $cause = null) {
        $params = array(
            "token" => $this->token
        );
        if ($cause !== null) {
            $params['cause'] = $cause;
        }

        $url = "http://ci.tenjava.com" . "/job/" . $name . "/build";
        $client = new GuzzleClient();

        $client->get($url, [
            'query' => $params,
            "auth" => [
                'tenjava',
                Config::get("webhooks.jenkins_token")]]);
    }
}