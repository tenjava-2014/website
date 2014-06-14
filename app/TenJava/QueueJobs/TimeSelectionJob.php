<?php
namespace TenJava\QueueJobs;

use \Config;
use \Github\Api\Repo;
use \Github\Client;
use \Github\Exception\ValidationFailedException;
use \Illuminate\Queue\Jobs\Job;

class TimeSelectionJob {

    public function fire(Job $job, $data) {
        $client = $this->getRepoApiClient();
        if ($data['t1']) {
            $this->addUserRepo($data['username'] . "-t1", $client);
        }
        if ($data['t2']) {
            $this->addUserRepo($data['username'] . "-t2", $client);
        }
        if ($data['t3']) {
            $this->addUserRepo($data['username'] . "-t3", $client);
        }
        $job->delete();
    }

    public function addUserRepo($username, Repo $client) {
        try {
            $client->create($username, 'Repository for a ten.java submission.', 'http://tenjava.com', true, null, false, false, false, null, true);
        } catch (ValidationFailedException $e) {
            // oh no!
        }
    }

    /**
     * @return Repo
     */
    public function getRepoApiClient() {
        $client = new Client();
        $client->authenticate("tenjava", Config::get("gh-data.pass"), Client::AUTH_HTTP_PASSWORD);
        return $client->api("repo");
    }
}