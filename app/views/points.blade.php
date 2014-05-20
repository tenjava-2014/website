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

    <p>Prizes for the winners of the contest are in the form of CurseForge points which can be earnt by creating and
        maintaining plugins and other addons on CurseForge sites (including BukkitDev). We rely on points donations to
        give us something we can distribute to the winners of the contest.</p>

    <h3>Top donors</h3>
    <ul id="topDonations" class="list">
        @foreach ($top as $key => $value)
            <li>{{{ $key }}} <span class="primary label">{{{ $value }}} {{ ($value == 1) ? "pt" : "pts" }}</span></li>
        @endforeach
    </ul>

    <h3>Recent donations</h3>
    <ul id="recentTransactions" class="list">
        @foreach ($recent as $element)
            <li>{{{ $element->username }}} <span class="primary label">{{{ $element->amount }}} {{ ($element->amount == 1) ? "pt" : "pts" }}</span></li>
        @endforeach
    </ul>

    <h2>How to donate</h2>
    <p>Points can be transferred by using the <a href="http://store.curseforge.com">CurseForge store</a> and transferring to the 'tenjava' user. This page is updated automatically. The last update was {{{ $last->diffForHumans() }}} and the next update is in {{{ $next->diffForHumans() }}}.</p>

    <small>Curse and Bukkit are in no way affiliated with this event.</small>

</div>
@stop
