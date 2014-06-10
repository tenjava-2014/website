@extends('layouts.master')
@section('content')
<div class="grid-container">
    <div class="grid-100">
<h2>App list ({{{ $apps->getTotal() }}} applications)</h2>
<div class="alert basic error">This page is restricted.
    @if ($fullAccess)
        <p>You currently have full access to all user data. You <strong>must not</strong> share this data with anyone (unless
        they too have this access).</p>
    @else
    <p>You currently have limited access to the information on this page. You <strong>must not</strong> share this data
        with anyone (unless they too have this access).</p>
    @endif
</div>

<p>Filter: <a href="?judges=1">judge apps</a>, <a href="?normal=1">participant apps</a>, <a href="/list">all apps</a>
</p>

<div class="text-center">{{ $apps->appends($append)->links() }}</div>

@foreach ($apps as $app)
    <h3 class="{{{ ($app->judge) ? 'judge-app' : 'participant-app' }}}">{{{ $app->gh_username }}} <a
        href="http://github.com/{{{ $app->gh_username }}}"><i class="fa fa-user"></i></a></h3>
    <table class="pure-table pure-table-bordered">
        <tbody>
        <tr>
            <td width="10%">Created at</td>
            <td width="90%"><span title="{{{ $app->created_at }}}">{{{ $app->created_at->diffForHumans() }}}</span></td>
        </tr>
        <tr>
            <td>DBO</td>
            <td><a href="http://dev.bukkit.org/profiles/{{{ $app->dbo_username }}}">{{{ $app->dbo_username }}}</a></td>
        </tr>
        <tr>
            <td>MC *</td>
            <td><a href="https://minecraft.net/haspaid.jsp?user={{{ $app->mc_username }}}">{{{ $app->mc_username }}}</a>
            </td>
        </tr>
        <tr>
            <td>Times</td>
            @if ($app->timeEntry == null)
                <td>User has not yet selected a time!</td>
            @else
                <td>{{ $app->timeEntry->t1 ? HTML::link("https://www.github.com/tenjava/" . $app->gh_username . "-t1", "Time 1" : "") }} {{ $app->timeEntry->t1 ? HTML::link("https://www.github.com/tenjava/" . $app->gh_username . "-t2", "Time 2" : "") }} {{ $app->timeEntry->t1 ? HTML::link("https://www.github.com/tenjava/" . $app->gh_username . "-t3", "Time 3" : "") }}</td>
            @endif
        </tr>
        @if ($fullAccess)
        <tr>
            <td>Emails</td>
            <td>{{{ $app->github_email }}}</td>
        </tr>
        @endif
        <tr>
            <td>IRC *</td>
            <td>{{{ $app->irc_username }}}</td>
        </tr>
        @if ($fullAccess)
        <tr>
            <td>GMail *</td>
            <td>{{{ $app->gmail }}}</td>
        </tr>
        @endif
        <tr>
            <td>Twitch #</td>
            <td><a href="http://twitch.tv/{{{ $app->twitch_username }}}">{{{ $app->twitch_username }}}</a></td>
        </tr>
        @if ($fullAccess && $app->judge)
        <tr>
            <td>Actions</td>
            <td>
            {{ Form::open(array('url' => '/list/accept', 'class' => 'action-form')) }}
                {{ Form::hidden('app_id', $app->id) }}
                {{ Form::submit('Accept app', ['class' => 'button button-small button-flat-action']); }}
            {{ Form::close() }}

            {{ Form::open(array('url' => '/list/decline', 'class' => 'action-form')) }}
                {{ Form::hidden('app_id', $app->id) }}
                {{ Form::submit('Decline app', ['class' => 'button button-small button-flat-primary']); }}
            {{ Form::close() }}
            </td>
        </tr>
        @endif
        </tbody>
    </table>
@endforeach

<div class="text-center">{{ $apps->appends($append)->links() }}</div>
        </div></div>
@stop
