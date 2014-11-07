<?php namespace TenJava\QueueJobs;

use Config;
use Illuminate\Queue\Jobs\Job;
use TenJava\CI\BuildCreationInterface;
use TenJava\Notification\IrcMessageBuilderInterface;
use TenJava\Notification\IrcNotifierInterface;
use TenJava\Repository\RepositoryActionInterface;
use TenJava\Repository\RepoWebhookInterface;

/**
 * Class TimeSelectionJob
 * @package TenJava\QueueJobs
 */
class TimeSelectionJob {

    /**
     * @var \TenJava\CI\BuildCreationInterface
     */
    private $builds;
    /**
     * @var \TenJava\Repository\RepoWebhookInterface
     */
    private $webhooks;
    /**
     * @var \TenJava\Notification\IrcNotifierInterface
     */
    private $irc;
    /**
     * @var \TenJava\Notification\IrcMessageBuilderInterface
     */
    private $ircMessage;
    /**
     * @var \TenJava\Repository\RepositoryActionInterface
     */
    private $repo;

    /**
     * @param BuildCreationInterface $builds
     * @param \TenJava\Repository\RepoWebhookInterface $webhooks
     * @param \TenJava\Notification\IrcNotifierInterface $irc
     * @param \TenJava\Notification\IrcMessageBuilderInterface $ircMessage
     * @param \TenJava\Repository\RepositoryActionInterface $repo
     */
    public function __construct(BuildCreationInterface $builds, RepoWebhookInterface $webhooks, IrcNotifierInterface $irc, IrcMessageBuilderInterface $ircMessage, RepositoryActionInterface $repo) {
        $this->builds = $builds;
        $this->webhooks = $webhooks;
        $this->irc = $irc;
        $this->ircMessage = $ircMessage;
        $this->repo = $repo;
    }

    /**
     * @param Job $job
     * @param $data
     */
    public function fire(Job $job, $data) {
        $client = $this->getRepoApiClient();
        if ($data['t1']) {
            $this->addUserRepo($data['username'] . '-t1', $client);
        }
        if ($data['t2']) {
            $this->addUserRepo($data['username'] . '-t2', $client);
        }
        if ($data['t3']) {
            $this->addUserRepo($data['username'] . '-t3', $client);
        }
        $job->delete();
    }

    /**
     * @return Repo
     */
    public function getRepoApiClient() {
        $client = new Client();
        $client->authenticate('tenjava', Config::get('gh-data.pass'), Client::AUTH_HTTP_PASSWORD);
        return $client->api('repo');
    }

    /**
     * @param $username
     * @param Repo $client
     */
    public function addUserRepo($username, Repo $client) {
        try {
            $client->create($username, 'Repository for a ten.java submission.', 'http://tenjava.com', true, null, false, false, false, null, true);
        } catch (ValidationFailedException $e) {
            // oh no!
        }

        $this->builds->createJob($username);
        $this->webhooks->addWebhook($username);
        $this->repo->setRepoActionComplete('webhook', $username);
        $this->repo->setRepoActionComplete('jenkins', $username);
        $this->irc->sendMessage('#ten.judge', $this->ircMessage->insertText('jkcclemens: I have good news! ')->insertSecureText($username)->insertText(' has chosen a time and needs a repo template :D'));
    }
}
