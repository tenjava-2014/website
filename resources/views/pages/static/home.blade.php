@extends('layouts.master')
@section('content')
<div id="post-header">
    <div class="grid-container header-container">
        <div class="grid-100 text-center">
            <h4 id="contestTime">Thanks for your support!</h4>
        </div>
    </div>
</div>
<div class="content-back">
    <div class="grid-container">
        <div class="grid-60">
            <p><em>Want to keep updated with the latest ten.java news? Ask to receive an email when news about the next contest is released <a href="/subscribe">here</a>!</em></p>
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
                <span class="text-light">We've raised {!! /*number_format($pointsData->points)*/ '10' !!} points! That's a whopping ${!! /*number_format($pointsData->points * 0.05, 2)*/ '10' !!}!</span>
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
@stop

