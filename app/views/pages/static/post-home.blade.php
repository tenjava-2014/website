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
            <p><em>Judge applications, participant registrations and time selections are now closed.</em></p>
            <p><strong>ten.java</strong> is an unofficial, biannual Bukkit plugin development contest. Created in early
                November by nkrecklow, with the first ever contest taking place on the 7th of December 2013, ten.java is
                a ten-hour competition to create an original plugin based on a theme. Plugins are judged by a group of
                volunteers, and we use CurseForge points to award prizes to the winning developers. Last year we had
                just under 90 registered participants.</p>

            <p>This year, in just under 2 weeks, we have managed to raise the equivalent of $700 in CurseForge points
                (14,000 in total) for use as a prize fund, solely due to the generosity of the developer community. Over
                200 participants have signed up, and we've been blown away by the response on Twitter, the Bukkit
                forums, and in IRC.</p>

            <p>If you're interested in getting involved, you can sign up as a participant or apply to be a judge using
                the links to the right. If you have spare CurseForge points you'd like to donate, use the donate button
                to learn how.</p>

            <p>Once you've signed up, you might like to have a look at our <a href="/wiki">wiki</a> which includes
                information on Git, Maven, getting started with the contest and more.</p>
        </div>
        <div class="grid-30 mobile-grid-100 tablet-grid-100 pull-right text-center">

			@if($hst == 'notime')
            <p>You have not chosen a timeslot in the required time and cannot participate.</p>
	        @elseif($hst != 'noapp' && $hst != 'notime')
	        <p>You have completed every step for signing up! Thank you for your participation, and good luck!</p>
	        @endif
            <!-- <p>
                <a href="/results" class="button button-block button-large button-flat-action">View results</a>
                <span class="text-light">View the winning entries!</span>
            </p>-->
            <p>
               <a href="https://www.youtube.com/watch?v=cQ-FQ9ee2Yo" class="button button-block button-large button-flat-action">View results live stream</a>
               <span class="text-light">We'll be announcing the results at 7PM on August 30th.</span>
           </p>
            <p>
                <a href="/themes" class="button button-block button-flat-royal">View contest themes</a>
                <span class="text-light">View the available themes for each timeslot.</span>
            </p>
            <p>
                <a href="/points#donate" class="button button-block button-flat-highlight">Make a Donation</a>
                <span class="text-light">We've raised {{ number_format($pointsData->points) }} points! That's a whopping ${{ number_format($pointsData->points * 0.05, 2) }}!</span>
            </p>

            <div class="tf2-details">
                <p>We have a TF2 server available and will be playing before and after the results are announced. If you'd like to join us, connect to thor.tenjava.com</p>
            </div>

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

