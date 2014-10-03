@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container streams">
        <div class="grid-100">
            <h2>All online streamers</h2>
            @if (count($twitch) == 0)
                <p>There are no online streams.</p>
            @else
                <p>This page lists all online streams. This data is updated every ten minutes.</p>
            @endif
        </div>
        @if (count($twitch) != 0)
            @include("partials.twitch", array("full" => true))
        @endif
        <div class="grid-100">
            <h2>Other streaming platforms</h2>
            <p>Some participants have elected to use an alternative streaming platform in place of twitch.tv. We don't check the status of these streams, but provide a list below for convenience:</p>
        </div>
        @include("partials.generic-stream", array("streams" => [["url" => "http://www.hitbox.tv/thekomputerking", "preview" => "http://edge.sf.hitbox.tv/static/img/live/thekomputerking_large_000.jpg", "username" => "TheKomputerKing"],["url" => "http://www.justin.tv/turt2live", "preview" => "http://static-cdn.jtvnw.net/previews/live_user_turt2live-600x400.jpg", "username" => "turt2live"]]))
    </div>
</div>
@stop
