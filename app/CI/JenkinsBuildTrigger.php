<?php
namespace TenJava\CI;

use Config;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use Log;

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
        try {
            $client->get($url, [
                'query' => $params,
                "auth" => [
                    'tenjava',
                    Config::get("webhooks.jenkins_token")]]);
        } catch (ClientException $e) {
            Log::error("Jenkins Request failed. Ignoring.. " . $e->getMessage());
        }

    }
}