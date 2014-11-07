<?php namespace TenJava\Repository;

use Config;

/**
 * Class GitHubRepoWebhook
 * @package TenJava\Repository
 */
class GitHubRepoWebhook implements RepoWebhookInterface {

    /**
     * @var \Github\Api\Repository\Hooks
     */
    // private $apiClient;

    /**
     * Constructor.
     */
    public function __construct() {
        // $this->apiClient = $this->getApiClient();
    }

    /**
     * @param string $repoName Participant repo name. E.g. lol768-t1
     */
    public function addWebhook($repoName) {
        // $this->apiClient->create("tenjava", $repoName, $this->getWebhookData());
    }

    /**
     * @param string $repoName Participant repo name. E.g. lol768-t1
     */
    public function updateWebhook($repoName) {
        /*$theHook = $this->apiClient->all("tenjava", $repoName)[0];
        if ($theHook !== null) {
            $hookId = $theHook['id'];
            $this->apiClient->update("tenjava", $repoName, $hookId, $this->getWebhookData());
        }*/
    }

    /**
     * @return \Github\Api\Repository\Hooks
     */
    private function getApiClient() {
        /*$client = new Client();
        $client->authenticate("tenjava", Config::get("gh-data.pass"), Client::AUTH_HTTP_PASSWORD);
        /** @var \Github\Api\Repo $repo */
        /*$repo =  $client->api('repo');
        return $repo->hooks();*/
    }

    /**
     * @return array The webhook data.
     */
    private function getWebhookData() {
        /*$dataArray = [
            'name' => 'web',
            'events' => [
                'push',
                'pull_request'],
            'active' => true];
        $dataArray['config'] = [
            'url' => url('/webhook/fire'),
            'content_type' => 'json',
            'secret' => Config::get("webhooks.secret")
        ];
        return $dataArray;*/
    }
}
