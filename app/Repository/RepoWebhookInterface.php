<?php namespace TenJava\Repository;


interface RepoWebhookInterface {
    public function addWebhook($repoName);

    public function updateWebhook($repoName);
}
