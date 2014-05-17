@extends('layout')

@section('content')
<div class="three centered columns">
    <p><img id="logo" src="/assets/img/drawing_1.svg"></p>
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

    <div class=" centered" id="buttons">
        <div class="medium metro rounded btn primary icon-left entypo icon-trophy">
            <a href="/register">Register as participant</a>
        </div>
        <div class="medium metro rounded btn primary icon-left entypo icon-users">
            <a href="/judge">Apply as judge</a>
        </div>
        <div class="medium metro rounded btn primary icon-left entypo icon-twitter">
            <a href="https://twitter.com/tenjava">Twitter</a>
        </div>
    </div>
</div>
@stop