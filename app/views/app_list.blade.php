@extends('layout')

@section('title')
Applicant list -
@stop

@section('content')
<div class="three centered columns">
    <p><a href="/"><img id="logo" src="/assets/img/drawing_1.svg"></a></p>
</div>
<div class="twelve columns" id="intro">
    <h2>App list ({{{ $apps->getTotal() }}} applications)</h2>
    <p>Filter: <a href="?judges=1">judge apps</a> <a href="?normal=1">participant apps</a> <a href="/list">all apps</a></p>

    <div class="pagination">{{ $apps->appends($append)->links() }}</div>

    @foreach ($apps as $app)
        <h3 style="color: #{{ ($app->judge) ? "0a0" : "00a" }}">{{{ $app->gh_username }}} <a href="http://github.com/tenjava/{{{ $app->gh_username }}}"><i class="icon-github"></i></a></h3>
        <table class="striped rounded">
            <tbody>
            <tr>
                <td>Created at</td>
                <td><span title="{{{ $app->created_at }}}">{{{ $app->created_at->diffForHumans() }}}</span></td>
            </tr>
            <tr>
                <td>DBO</td>
                <td>{{{ $app->dbo_username }}}</td>
            </tr>
            <tr>
                <td>MC *</td>
                <td>{{{ $app->mc_username }}}</td>
            </tr>
            <tr>
                <td>Emails</td>
                <td>{{{ $app->github_email }}}</td>
            </tr>
            <tr>
                <td>IRC *</td>
                <td>{{{ $app->irc_username }}}</td>
            </tr>
            <tr>
                <td>GMail *</td>
                <td>{{{ $app->gmail }}}</td>
            </tr>
            <tr>
                <td>Twitch</td>
                <td>{{{ $app->twitch_username }}}</td>
            </tr>
            </tbody>
        </table>
    @endforeach

    <div class="pagination">{{ $apps->appends($append)->links() }}</div>
</div>
@stop
