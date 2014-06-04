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
            <h4>So far, we've raised {{ number_format($data->points) }}
                (${{ number_format(round($data->points / 20, 2)) }}) points from {{{ $totalCount }}} people.</h4>
        </div>
        <div class="grid-80">
            <a id="top"></a>
            <h3>Top donors</h3>

            <p>Thanks to our top donors for their contributions!</p>
            <ul class="list-large">
                @foreach ($top as $key => $value)
                <li>{{{ $key }}} ({{{ $value }}} {{ ($value == 1) ? "pt" : "pts" }})</li>
                @endforeach
            </ul>

        </div>
        <div class="grid-20 hide-on-mobile signup-image signup-margin">
            <img src="/assets/img/thirdparty/list.svg">
        </div>

        <div class="grid-80">
            <a id="recent"></a>
            <h3>Recent donors</h3>

            <p>Thanks to our recent donors for their contributions!</p>
            <ul class="list-large">
                @foreach ($recent as $element)
                <li>{{{ $element->username }}} ({{{ $element->amount }}} {{ ($element->amount == 1) ? "pt" : "pts" }})
                </li>
                @endforeach
            </ul>

        </div>
        <div class="grid-20 hide-on-mobile signup-image signup-margin">
            <img src="/assets/img/thirdparty/clock.svg">
        </div>

    </div>
</div>
<div class="grid-container">
    <!-- <div class="grid-50">
        <h1>Top Donors</h1>
        <ul class="list-large">
            @foreach ($top as $key => $value)
            <li>{{{ $key }}} ({{{ $value }}} {{ ($value == 1) ? "pt" : "pts" }})</li>
            @endforeach
        </ul>
    </div>-->


    <div class="grid-80">
        <a id="donate"></a>
        <h3>Donate points</h3>

        <p>You can help us increase our prize fund by sending CurseForge points to the 'tenjava' user. To do so, simply
            click the button below and select the 'Transfer Points' option in the top navigation bar.</p>
        <p><a href="https://store.curseforge.com" class="button button-large button-flat-action">Visit store</a></p>
    </div>
    <div class="grid-20 hide-on-mobile signup-image signup-margin">
        <img src="/assets/img/thirdparty/send.svg">
    </div>

</div>
@stop