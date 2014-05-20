@extends('layout')

@section('title')
Points -
@stop

@section('content')
    <div class="three centered columns">
        <p><a href="/"><img id="logo" src="/assets/img/drawing_1.svg"></a></p>
    </div>
    <div class="twelve columns" id="intro">
        <h2>Points <span class="secondary badge" id="points">{{ $data->points}} total points</span></h2>

        <p>Prizes for the winners of the contest are in the form of CurseForge points which are given out to all developers
            who sign up to the scheme (applies to BukkitDev, CurseForge and other sites). Developers with more popular
            projects will receive more points. We rely on point donations to form the contest prize. The more points given,
            the more we can give out to the winning developers.</p>

        <h3>Top donors</h3>
        <ul id="topDonations" class="list">
            @foreach ($top as $key => $value)
                <li>{{{ $key }}} <span class="primary label">{{{ $value }}} {{ ($value == 1) ? "pt" : "pts" }}</span></li>
            @endforeach
        </ul>

        <h3>Recent donations</h3>
        <ul id="recentTransactions" class="list">
            @foreach ($recent as $element)
                <li>{{{ $element->username }}} <span class="primary label">{{{ $element->amount }}} {{ ($element->amount == 1) ? "pt" : "pts" }}</span>
                </li>
            @endforeach
        </ul>

        <h2>How to donate</h2>

        <p>Points can be sent by using the <a href="http://store.curseforge.com">CurseForge store</a> and transferring to
            the 'tenjava' user.
        </p>
        <a href="http://store.curseforge.com"><img src="/assets/img/points.png" /></a>

        <small>This page is updated automatically. The last update was {{{ $last->diffForHumans() }}} and
            the next update is in {{{ $next->diffForHumans() }}}. Curse and Bukkit are in no way affiliated with this event.</small>

    </div>
@stop
