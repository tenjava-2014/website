<?php


namespace TenJava\Repository;


use TenJava\Models\ParticipantCommit;

class EloquentParticipantCommitRepository implements ParticipantCommitRepositoryInterface {

    /**
     * @param int $max The number of commits to get.
     * @return array Array of recent commits with up to the max no. of commits.
     */
    public function getRecentCommits($max = 5) {
        return ParticipantCommit::orderBy("id", "desc")->take($max)->get();
    }

    /**
     * @return array Array of all commits.
     */
    public function getAllCommits() {
        return ParticipantCommit::all();
    }
}