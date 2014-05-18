@extends('layout')

@section('content')
<div class="three centered columns">
    <p><img id="logo" src="/assets/img/drawing_1.svg"></p>
</div>
<div class="twelve columns" id="intro">
    <h2>App list (restricted)</h2>

    @foreach ($apps as $app)
        <h3>{{{ $app->gh_username }}}</h3>
        <ul>
            <li>DBO: {{{ $app->dbo_username }}}</li>
            <li>MC: {{{ $app->mc_username }}}</li>
            <li>Emails: {{{ $app->github_email }}}</li>
            <li>IRC: {{{ $app->irc_username }}}</li>
            <li>GMail: {{{ $app->gmail }}}</li>
            <li>Judge app: {{{ $app->judge }}}</li>
        </ul>
    @endforeach

    {{ $apps->links() }}
</div>
@stop
