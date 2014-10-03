@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Points</h2>
            <p>Prizes for the winners of the contest are in the form of CurseForge points which are given out to all
                developers who sign up to the scheme (applies to BukkitDev, CurseForge and other sites). Developers with
                more popular projects will receive more points. We rely on point donations to form the contest prize.
                The more points given, the more we can give out to the winning developers. For more stats on point donations, see <a href="http://kyleclemens.com/tenjava">this page</a>.</p>
        </div>
        <div class="grid-100">
            <h3>CurseForge</h3>
            <p><a href="http://curseforge.com">CurseForge</a> has sponsored us and generously provided us with an additional 20,000 points to distribute to our winning developers.</p>
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
        <img src="{{ asset('/assets/img/thirdparty/send.svg') }}" alt="Send icon">
    </div>
</div> -->
@stop
