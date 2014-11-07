<?php namespace TenJava\Contest;

interface ParticipantRepositoryInterface {
    public function getConfirmedParticipants();

    public function getParticipantByAuthId($id);

    public function getParticipantCount();

    public function getParticipantsWithCommitCount();

    public function getUnconfirmedParticipants();
}
