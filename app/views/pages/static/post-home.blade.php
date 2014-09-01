@extends('layouts.master')
@section('content')
<div id="post-header">
    <div class="grid-container header-container">
        <div class="grid-100 text-center">
            <h4 id="contestTime">Time until contest start:</h4>
            <!-- For some reason, PHP decides that string representations of booleans should be "1" for true and "" for false -->
            <!-- As much as this is intuitive, we're going to use a ternary operator here to get something sensible. -->
            <div id="times-info" data-t1="{{{ $contestTimes->getTimeUntil($contestTimes->getT1StartTime()) }}}"
                                 data-t2="{{{ $contestTimes->getTimeUntil($contestTimes->getT2StartTime()) }}}"
                                 data-t3="{{{ $contestTimes->getTimeUntil($contestTimes->getT3StartTime()) }}}"
                                 data-res="{{{ $contestTimes->getTimeUntil($contestTimes->getResultsAnnouncement()) }}}"
                                 data-t1-active="{{{ $contestTimes->isT1Active() ? 'true' : 'false' }}}"
                                 data-t2-active="{{{ $contestTimes->isT2Active() ? 'true' : 'false' }}}"
                                 data-t3-active="{{{ $contestTimes->isT3Active() ? 'true' : 'false' }}}"></div>
            <div class="time-circle" data-timer="900"></div>
        </div>
    </div>
</div>
<div class="content-back">
    <div class="grid-container">
        <div class="grid-60">
            <p><em>Took part this year and want to see what we thought of your entry? View the feedback <a href="/own-scores">here</a>!</em></p>
            <p><strong>ten.java</strong> is an unofficial, biannual Bukkit plugin development contest. Created in early
                November by nkrecklow, with the first ever contest taking place on the 7th of December 2013, ten.java is
                a ten-hour competition to create an original plugin based on a theme. Plugins are judged by a group of
                volunteers, and we use CurseForge points to award prizes to the winning developers. Last year we had
                just under 90 registered participants.</p>

            <p>This year, we were able to raise 22,000 points solely due to donations from the community. We were lucky
            enough to be sponsored by CurseForge who donated an additional 20,000 points to the prize fund. This brought
            us up to a total of $2,100 to be distributed amongst the winning developers.</p>

            <p>On August 30th, after a month of judging, we announced the winning entries via a livestream.
            You can view the <a href="/results">results</a> page for more information.</p>
        </div>
        <div class="grid-30 mobile-grid-100 tablet-grid-100 pull-right text-center">
            <!-- <p>
                <a href="/results" class="button button-block button-large button-flat-action">View results</a>
                <span class="text-light">View the winning entries!</span>
            </p>-->
            <p>
               <a href="/results" class="button button-block button-large button-flat-action">View results</a>
               <span class="text-light">We announced the results at 7PM on August 30th.</span>
           </p>
            <p>
                <a href="/themes" class="button button-block button-flat-royal">View contest themes</a>
                <span class="text-light">View the themes we offered for each timeslot.</span>
            </p>
            <p>
                <a href="/points" class="button button-block button-flat-highlight">View point donations</a>
                <span class="text-light">We've raised {{ number_format($pointsData->points) }} points! That's a whopping ${{ number_format($pointsData->points * 0.05, 2) }}!</span>
            </p>

            <!-- <div class="tf2-details">
                <p>We have a TF2 server available and will be playing before and after the results are announced. If you'd like to join us, connect to thor.tenjava.com</p>
            </div> -->

        </div>
    </div>
</div>
@if(count($tweets) > 0)
    @include('partials.twitter')
@endif
@if(count($twitch) > 0)
    <div id="twitch">
        @include('partials.twitch')
    </div>
@endif
<div id="commits">
    @if(count($commits) > 0)
        @include('partials.commits')
    @endif
</div>
@stop

