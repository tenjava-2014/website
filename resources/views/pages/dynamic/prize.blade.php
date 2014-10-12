@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Prize</h2>
            <p>
                The prizes for the winners of the contest are collected via
                <a href="{!! URL::route('donate') !!}">this</a> page. We rely on donations in order to fill the prize
                pool. The more that is donated, the more that we can give to the winning developers.
            </p>
            <div class="alert basic info condensed text-center" id="points-total">
                <h3>
                    We've raised {{ $formatter->formatCurrency($totalMoney, 'USD') }}* from {{ $teams }} {{ Str::plural('person', $teams) }}!
                </h3>
                <h4>
                    That's {{ $goal }}% of our goal!
                </h4>
            </div>
        </div>
        <div class="grid-50">
            <a id="top"></a>
            <h3>Top donors</h3>
            <p>
                The following users have contributed the most money to the prize pool. Thank you for your help and
                contributions! Without these people, the prize pool would not be nearly as amazing.
            </p>
            <ol class="list-large" id="top-donors-list">
                @foreach ($top as $element)
                <li>
                    <a href="https://github.com/{{ $element->username }}">{{ $element->username }}</a> ({{ $formatter->formatCurrency($element->amount, 'USD') }})
                </li>
                @endforeach
            </ol>
        </div>
        <div class="grid-50">
            <a id="recent"></a>
            <h3>Recent donors</h3>
            <p>
                The following people have recently contributed money to the prize pool. Any very recent donations might
                take a few minutes to show up. Thank you for your help and contributions!
            </p>
            <ol class="list-large" id="recent-donors-list">
                @foreach ($recent as $element)
                <li>
                    {!! $element->user->link() !!} ({{ $formatter->formatCurrency($element->amount, 'USD') }})
                </li>
                @endforeach
            </ol>
        </div>
        <div class="grid-100">
            <p style="color: #919191;">
                <small>
                    * The total listed above includes hidden donations and may not reflect the sum of donations listed
                    here. In addition, a handling fee has been calculated for this total. This total is approximate.
                </small>
            </p>
        </div>
    </div>
</div>
<!-- <div class="grid-container">
    <div class="grid-80">
        <a id="donate"></a>
        <h3>Donate points</h3>
        <p>You can help us increase our prize fund by sending CurseForge points to the "tenjava" user. To do so, simply
            click the button below and select the 'Transfer Points' option in the top navigation bar.</p>
        <p><a href="https://store.curseforge.com" class="button button-large button-flat-action">Visit store</a></p>
    </div>
    <div class="grid-20 hide-on-mobile hide-on-tablet signup-image signup-margin">
        <img src="{!! asset('/assets/img/thirdparty/send.svg') !!}" alt="Send icon">
    </div>
</div> -->
@stop
