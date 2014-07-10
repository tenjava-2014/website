<?php
namespace TenJava\Contest;

interface ParticipantRepositoryInterface {

    public function getConfirmedParticipants();
    public function getUnconfirmedParticipants();
}