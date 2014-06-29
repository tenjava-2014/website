<?php


namespace TenJava\Repository;

interface ParticipantCommitRepositoryInterface {

    /**
     * @param int $max The number of commits to get.
     * @return array Array of recent commits.
     */
    public function getRecentCommits($max=5);

    /**
     * @return array Array of all commits.
     */
    public function getAllCommits();

} 