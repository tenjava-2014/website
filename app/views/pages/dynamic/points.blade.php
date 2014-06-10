@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Points</h2>
            <p>Prizes for the winners of the contest are in the form of CurseForge points which are given out to all
                developers who sign up to the scheme (applies to BukkitDev, CurseForge and other sites). Developers with
                more popular projects will receive more points. We rely on point donations to form the contest prize.
                The more points given, the more we can give out to the winning developers.</p>
            <div class="alert basic info condensed text-center" id="points-total"><h3>We've raised {{ number_format($data->points) }}
                ({{ money_format('$%i', round($data->points / 20, 2)) }}) points from {{{ $totalCount }}} people!</h3></div>
        </div>
        <div class="grid-50">
            <a id="top"></a>
            <h3>Top donors</h3>
            <p>The following users have contributed the most points to the prize pool. Thank you for your help and contributions! Without these people, the prize pool would not be nearly as amazing.</p>
            <ol class="list-large" id="top-donors-list">
                @foreach ($top as $key => $value)
                <li><a href="http://dev.bukkit.org/profiles/{{{ $key }}}">{{{ $key }}}</a> ({{{ $value }}} {{ ($value == 1) ? "pt" : "pts" }})</li>
                @endforeach
            </ol>

        </div>

        <div class="grid-50">
            <a id="recent"></a>
            <h3>Recent donors</h3>

            <p>The following people have recently contributed points to the prize pool. Any very recent donations might take a few minutes to show up. Thank you for your help and contributions!</p>
            <ol class="list-large" id="recent-donors-list">
                @foreach ($recent as $element)
                <li><a href="http://dev.bukkit.org/profiles/{{{ $element->username }}}">{{{ $element->username }}}</a> ({{{ $element->amount }}} {{ ($element->amount == 1) ? "pt" : "pts" }})
                </li>
                @endforeach
            </ol>

        </div>

    </div>
</div>
<div class="grid-container">

    <div class="grid-80">
        <a id="donate"></a>
        <h3>Donate points</h3>

        <p>You can help us increase our prize fund by sending CurseForge points to the "tenjava" user. To do so, simply
            click the button below and select the 'Transfer Points' option in the top navigation bar.</p>
        <p><a href="https://store.curseforge.com" class="button button-large button-flat-action">Visit store</a></p>
    </div>
    <div class="grid-20 hide-on-mobile hide-on-tablet signup-image signup-margin">
        <img src="{{ asset('/assets/img/thirdparty/send.svg') }}" alt="Send icon">
    </div>

</div>
@stop
