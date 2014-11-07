<?php namespace TenJava\CI;

use App;
use Config;
use GuzzleHttp\Client;
use Illuminate\Filesystem\Filesystem;
use Log;

class JenkinsBuildCreation implements BuildCreationInterface {

    private $jobConfig;

    public function __construct() {
        if (!App::environment('local')) {
            $this->jobConfig = (new Filesystem())->get(base_path() . '/../app_config/config.xml');
        }
    }

    public function createJob($repoName) {

        $jobConfig = str_replace('%%REPO_NAME%%', $repoName, $this->jobConfig);
        Log::info('Sending req for new jenkins job ' . $jobConfig);
        $client = new Client();
        $client->post('http://ci.tenjava.com/createItem', [
            'auth' => [
                'tenjava',
                Config::get('webhooks.jenkins_token')
            ],
            'query' => ['name' => $repoName],
            'headers' => ['Content-Type' => 'application/xml'],
            'body' => $jobConfig, 'debug' => true]);
    }
}
