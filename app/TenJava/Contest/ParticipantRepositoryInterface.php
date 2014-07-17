<?php
namespace TenJava\Contest;

interface ParticipantRepositoryInterface {
    public function getConfirmedParticipants();
    public function getUnconfirmedParticipants();
    public function getParticipantByAuthId($id);
    public function getParticipantCount();
    public function getParticipantsWithCommitCount();
}