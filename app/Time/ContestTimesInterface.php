<?php namespace TenJava\Time;

interface ContestTimesInterface {
    function getResultsAnnouncement();

    function getT1EndTime();

    function getT1StartTime();

    function getT2EndTime();

    function getT2StartTime();

    function getT3EndTime();

    function getT3StartTime();

    function getTimeUntil($event);

    function isT1Active();

    function isT1Finished();

    function isT2Active();

    function isT2Finished();

    function isT3Active();

    function isT3Finished();
}
