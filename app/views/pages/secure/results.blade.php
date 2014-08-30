<!-- to be stored in results.blade.php. IMPORTANT: Do not publish this unless the results have been announced! -->
@extends('layouts.master')
@section('content')
<div class="grid-container">
	<div class="grid-100 grid-parent">
        <h2>Contest Results</h2>
        <p>We've had great fun testing and judging all of the entries and we're excited to announce the winning entries
        along with the rest of the top ten.</p>
    </div>
    <div class="grid-90 grid-padding-sucks">
        <h3>3rd Place &mdash; turt2live's entry for timeslot 3</h3>
        <p>
            turt2live's entry included a world generator that created a new world: "tenjavria". The entry added body
            temperatures to each player which is influenced by the types of block around the player. Being too hot or too
            cold can result in losing items, health or walking speed. We thought the idea behind the entry was great and we
            liked the included world generation.
        </p>
        <div class="result-actions">
            <a href="https://github.com/tenjava/turt2live-t3" class="button button-flat-royal">View repo</a>
        </div>
    </div>
    <div class="grid-10 hide-on-mobile signup-image grid-padding-sucks">
        <img src="{{ asset('/assets/img/medals/medal_bronze.png') }}" alt="Medal icon">
    </div>

    <div class="grid-90 grid-padding-sucks">
        <h3>2nd Place &mdash; mbaxter's entry for timeslot 3</h3>
        <p>
            mbaxter's plugin adds an aptly-dubbed "WonderBow" that users with necessary permissions can access via a
            command. The WonderBow chooses a random "Wonder" to be applied upon each shot. Available effects range
            from floating chickens to exploding cows. We had great fun playing with this entry and were impressed by
            the use of new language features and overall code structure.
        </p>
        <div class="result-actions">
            <a href="https://github.com/tenjava/mbax-t3" class="button button-flat-royal">View repo</a>
        </div>
    </div>
    <div class="grid-10 hide-on-mobile signup-image grid-padding-sucks">
        <img src="{{ asset('/assets/img/medals/medal_iron.png') }}" alt="Medal icon">
    </div>

    <div class="grid-90 grid-padding-sucks">
        <h3>1st Place &mdash; Ribesg's entry for timeslot 2</h3>
        <p>
            In Ribesg's entry for time two, every player is a robot! As such, each player must manage their power level, and use
            charging stations to keep their energy level up. Being a robot, players can expend extra energy to enable awesome
            powers, such as flight. This creates a reasonable potential for enabling flying and other powers on servers, as robots
            are all powered by fuel that must be harvested, so no one can abuse the system. BEEP BOOP.
        </p>
        <div class="result-actions">
            <a href="https://github.com/tenjava/Ribesg-t2" class="button button-flat-royal">View repo</a>
        </div>
    </div>


    <div class="grid-10 hide-on-mobile signup-image grid-padding-sucks">
        <img src="{{ asset('/assets/img/medals/medal_gold.png') }}" alt="Medal icon">
    </div>

    <div class="grid-90 grid-padding-sucks">
        <h3>Top ten</h3>
        <p>
            The top ten entries were:
        </p>
            <ol>
                <li>Ribesg-t2</li>
                <li>mbax-t3</li>
                <li>turt2live-t3</li>
                <li>yawkat-t2</li>
                <li>mncat77-t3</li>
                <li>Vilsol-t3</li>
                <li>slipcor-t2</li>
                <li>Minecrell-t2</li>
                <li>hintss-t3</li>
                <li>Lolmewn-t2</li>

            </ol>

    </div>
    <div class="grid-10 hide-on-mobile signup-image grid-padding-sucks">
        <img src="{{ asset('/assets/img/thirdparty/trophy.svg') }}" alt="Trophy icon">
    </div>

    <div class="grid-100 grid-padding-sucks"><br /><small>We won't enter into discussions relating to the winning entries. The organizers' decision is final.</small></div>
</div>
@stop
