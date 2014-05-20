@extends('layout')

@section('content')
<div class="three centered columns">
    <p><a href="/"><img id="logo" src="/assets/img/drawing_1.svg"></a></p>
</div>
<div class="twelve columns" id="intro">
    <p><strong>ten.java</strong> is an unofficial, bi-annual Bukkit plugin development contest. Created in early
        November by nkrecklow with the first ever contest taking place on the 7th December 2013, ten.java is a
        ten hour competition to create an original plugin based on a theme. Plugins are judged by a group of
        volunteers and we use CurseForge points to award prizes to the winning developers. Last year we had just
        under 90 registered participants.</p>

    <p>This time we're hoping to see even more people participating. We've set a provisional date of <strong>July
            12th</strong> for this year's first event. If you're interested in getting involved as a
        participant, please signup below. The only thing you need is a GitHub account (to commit your code) and
        a BukkitDev account (to receive your points if you win). You can also apply to be a judge below.</p>

    <p>When you use the buttons below, you'll be redirected to GitHub to authorise the application. We ask GitHub for an
        email so that we can contact you if you win (this info will not be shared and will be used for the sole purpose
        of communications directly related to the contest). We also use the API to retrieve your GitHub username. This
        username is used to create a repository on the tenjava github account and then added to the newly-created repo
        with full
        access.
        @if (!$noEmail)
            If you're unwilling to provide an email at any stage, please click <a href="/no-email">here</a> and then signup
            normally.
        @else
            You're currently opted out of email sharing. If you wish to opt back in,  please click <a href="/no-email?undo=1">here</a> and then signup
            normally.
        @endif
    </p>

    <div class="six centered columns" id="buttons">
        <div class="row">
            <div class="medium metro rounded btn primary icon-left entypo icon-trophy">
                <a href="/register">Register as participant</a>
            </div>
            <div class="medium metro rounded btn primary icon-left entypo icon-users">
                <a href="/judge">Apply as judge</a>
            </div>
            <div class="row">
                <div class="medium metro rounded btn default icon-left entypo icon-twitter">
                    <a href="https://twitter.com/tenjava">Twitter</a>
                </div>
                <div class="medium metro rounded btn default icon-left entypo icon-heart">
                    <a href="/points">Points leaderboard</a>
                </div>
            </div>

        </div>
    </div>
</div>
@stop