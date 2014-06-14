<?php
namespace TenJava\QueueJobs;

use Config;
use \Github\Exception\ValidationFailedException;
use \Illuminate\Queue\Jobs\Job;
use \GitHub\Client as GitHubClient;
use Log;

class TimeRemovalJob {

    /** TEST */
    public function fire(Job $job, $data) {
        Log::info("inb4 log doesn't even work");
        $client = $this->getRepoApiClient();

        if ($data['t1']) {
            $this->deleteUserRepo($data['username'] . "-t1", $client);
        }
        if ($data['t2']) {
            $this->deleteUserRepo($data['username'] . "-t2", $client);
        }
        if ($data['t3']) {
            $this->deleteUserRepo($data['username'] . "-t3", $client);
        }
        $job->delete();
    }

    public function deleteUserRepo($username) {
        try {
            $this->getRepoApiClient()->remove("tenjava", $username);
        } catch (ValidationFailedException $e) {
            // oh no!
        }
    }

    /**
     * @return \Github\Api\Repo
     */
    public function getRepoApiClient() {
        $client = new GitHubClient;
        $client->authenticate("tenjava", Config::get("gh-data.pass"), GitHubClient::AUTH_HTTP_PASSWORD);
        return $client->api("repo");
    }

}