<?php

namespace TenJava\Time;

interface ContestTimesInterface {
    function getT1StartTime();
    function getT2StartTime();
    function getT3StartTime();
    function getT1EndTime();
    function getT2EndTime();
    function getT3EndTime();
    function isT1Active();
    function isT2Active();
    function isT3Active();
    function getTimeUntil($event);
}