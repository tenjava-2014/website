<?php namespace TenJava\Time;

use Config;

class ContestTimes implements ContestTimesInterface {

    private $tenHours = 36000;

    function getResultsAnnouncement() {
        return Config::get("contest-times.results");
    }

    function getTimeUntil($event) {
        return ($event - time());
    }

    function isT1Active() {
        return ($this->getT1StartTime() <= time() && time() <= $this->getT1EndTime());
    }

    function getT1StartTime() {
        return Config::get("contest-times.t1");
    }

    function getT1EndTime() {
        return $this->getT1StartTime() + $this->tenHours;
    }

    function isT1Finished() {
        return (time() > $this->getT1EndTime());
    }

    function isT2Active() {
        return ($this->getT2StartTime() <= time() && time() <= $this->getT2EndTime());
    }

    function getT2StartTime() {
        return Config::get("contest-times.t2");
    }

    function getT2EndTime() {
        return $this->getT2StartTime() + $this->tenHours;
    }

    function isT2Finished() {
        return (time() > $this->getT2EndTime());
    }

    function isT3Active() {
        return ($this->getT3StartTime() <= time() && time() <= $this->getT3EndTime());
    }

    function getT3StartTime() {
        return Config::get("contest-times.t3");
    }

    function getT3EndTime() {
        return $this->getT3StartTime() + $this->tenHours;
    }

    function isT3Finished() {
        return (time() > $this->getT3EndTime());
    }
}
