<?php

namespace TenJava\Time;

use Config;

class ContestTimes implements ContestTimesInterface {

    private $tenHours = 36000;

    function getT1StartTime() {
        return Config::get("contest-times.t1");
    }

    function getT2StartTime() {
        return Config::get("contest-times.t2");
    }

    function getT3StartTime() {
        return Config::get("contest-times.t2");
    }

    function getT1EndTime() {
        return $this->getT1StartTime() + $this->tenHours;
    }

    function getT2EndTime() {
        return $this->getT2StartTime() + $this->tenHours;
    }

    function getT3EndTime() {
        return $this->getT3StartTime() + $this->tenHours;
    }

    function isT1Active() {
        return ($this->getT1StartTime() <= time() && time() <= $this->getT1EndTime());
    }

    function isT2Active() {
        return ($this->getT2StartTime() <= time() && time() <= $this->getT2EndTime());
    }

    function isT3Active() {
        return ($this->getT3StartTime() <= time() && time() <= $this->getT3EndTime());
    }

    function getTimeUntil($event) {
        return ($event - time());
    }

    function isT1Finished() {
        return (time() > $this->getT1EndTime());
    }

    function isT2Finished() {
        return (time() > $this->getT2EndTime());
    }

    function isT3Finished() {
        return (time() > $this->getT3EndTime());
    }
}