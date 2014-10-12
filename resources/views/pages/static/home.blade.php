@extends('layouts.master')
@section('content')
<div id="post-header">
    <div class="grid-container header-container">
        <div class="grid-100 text-center">
            <h4>
                The unofficial Minecraft plugin contest<br/>
                <small>Coming soon</small>
            </h4>
        </div>
    </div>
</div>
<div class="content-back">
    <div class="grid-container">
        <div class="grid-60">
            <p>
                <em>
                    Want to keep updated with the latest ten.java news? Ask to receive an email when news about the next
                    contest is released <a href="/subscribe">here</a>!
                </em>
            </p>
            <p>
                <strong>ten.java</strong> is an unofficial, biannual Minecraft plugin development contest. Created in
                November of 2013 by nkrecklow, with the first ever contest taking place on December 7 of the same year,
                ten.java is a ten-hour competition to create an original plugin based on a theme. Plugins are judged
                by a group of volunteers, and we award a prize to the winning developers. Last year, we gave out $2,100
                USD and had just under 300 registered participants.
            </p>
            <p>
                On August 30, 2014, after a month of judging, we announced the winning entries of last year's
                competition via a livestream. You can view the <a href="/results">results</a> page for more information.
            </p>
            <p>
                News about the next competition can be obtained in the
                <a href="http://forums.tenjava.com/category/news">News category</a> on the forums. Alternatively, there
                are news emails that reiterate posts in that category that can be signed up for
                <a href="/subscribe">here</a>.
            </p>
        </div>
        <div class="grid-30 mobile-grid-100 tablet-grid-100 pull-right text-center">
            <!-- <p>
                <a href="/results" class="button button-block button-large button-flat-action">View results</a>
                <span class="text-light">View the winning entries!</span>
            </p>-->
            <p>
                <a href="{!! URL::route('donate') !!}" class="button button-block button-large button-flat-action">Donate to the prize pool</a>
                <span class="text-light">Help us reward the winners!</span>
            </p>
            <p>
                <a href="{!! URL::route('prize') !!}" class="button button-block button-flat-royal">View prize donations</a>
                <span class="text-light">We have raised {{ $formatter->formatCurrency($pointsData['totalMoney'], 'USD') }}!</span>
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

