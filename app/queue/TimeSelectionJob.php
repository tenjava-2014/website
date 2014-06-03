<?php


class TimeSelectionJob {

    public function fire($job, $data) {
        $client = $this->getApiClient();
        if ($data['t1']) {
            $this->addUserRepo($data['username'] . "-t1", $client);
        }
        if ($data['t2']) {
            $this->addUserRepo($data['username'] . "-t2", $client);
        }
        if ($data['t3']) {
            $this->addUserRepo($data['username'] . "-t3", $client);
        }
    }

    public function addUserRepo($username, $client) {
        $repo = $client->api('repo')->create($username, 'Repository for a ten.java submission.', 'http://tenjava.com', true, null, false, false, false, null, true);
    }

    /**
     * @return \Github\Client
     */
    public function getApiClient() {
        $client = new \Github\Client();
        $client->authenticate("tenjava", Config::get("gh-data.pass"), \GitHub\Client::AUTH_HTTP_PASSWORD);
        return $client;
    }
}