@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="content-back">
        <div class="grid-container">
            <div class="grid-60">
                @if ($isLeader)
                @if ($team->members->count() < 3 || $team->members->count() > 5)
                <div class="alert block error">
                    <h4>This team is not valid!</h4>
                    <p>
                        Teams must have between three and five members, including the leader. This team has
                        {{ $team->members->count() }} {{ Str::plural('member', $team->members->count()) }}.
                    </p>
                </div>
                @endif
                @endif
                <h1>{{ $team->name }}@if ($isLeader) <a href="{!! URL::route('update_team') !!}"><i class="fa fa-pencil"></i></a>@endif</h1>
                <h2>Description</h2>
                <div class="team-info">
                    {!! $description !!}
                </div>
                <h2>General Rules</h2>
                <div class="team-info">
                    {!! $general_rules !!}
                </div>
                <h2>Prize Rules</h2>
                <div class="team-info">
                    {!! $prize_rules !!}
                </div>
                @if ($miscellaneous_rules !== null)
                <h2>Miscellaneous Rules</h2>
                <div class="team-info">
                    {!! $miscellaneous_rules !!}
                </div>
                @endif
            </div>
            <div class="grid-30 mobile-grid-100 tablet-grid-100 pull-right">
                @if ($errors->any())
                <div class="alert block error">
                    <h4>Request errors</h4>
                    <ul>
                        @foreach($errors->all('<li>:message</li>') as $message)
                        {!! $message !!}
                        @endforeach
                    </ul>
                </div>
                @endif
                <h2>Members ({{ $team->members->count() }})</h2>
                @foreach ($team->members as $member)
                @include('partials.user', [
                    'user' => $member,
                    'useLeader' => true,
                    'removeLink' => $isLeader && $member->id !== $team->leader_id ? URL::route('remove_from_team', [$member]) : (!$isLeader && $member->id === Auth::id() ? URL::route('leave_team') : false),
                    'acceptLink' => false
                ])
                @endforeach
                @if (Auth::check())
                @if ($isMember)
                    <h2>Invites ({{ $team->invites->count() }})</h2>
                    @foreach ($team->invites as $invite)
                    @include('partials.user', [
                        'user' => $invite->user,
                        'useLeader' => false,
                        'removeLink' => $isLeader ? URL::route('uninvite', [$invite]) : false,
                        'acceptLink' => false
                    ])
                    @endforeach
                    @if ($isLeader && $team->members->count() < 5)
                        <div class="text-center">
                            {!! Form::open(['url' => '/teams/invite', 'class' => 'form']) !!}
                            <div class="control-group">
                                <div class="control">
                                {!! Form::text('invitee', null, ['placeholder' => 'GitHub username']) !!}
                                </div>
                            {!! Form::submit('Invite', ['class' => 'button button-tiny button-flat-primary']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    @endif
                    <h2>Requests ({{ $team->requests->count() }})</h2>
                    @foreach ($team->requests as $request)
                    @include('partials.user', [
                        'user' => $request->user,
                        'useLeader' => false,
                        'removeLink' => $isLeader ? URL::route('remove_request', [$request]) : false,
                        'acceptLink' => $isLeader ? URL::route('accept_request', [$request]) : false
                    ])
                    @endforeach
                @endif
                <div class="text-center">
                    @if (Auth::user()->team_id === null)
                        @if ($invite)
                        <p>
                            <a href="{!! URL::route('accept_invite', [$invite]) !!}" class="button button-block button-large button-flat-primary">Accept invite</a>
                            <span class="text-light">Accepting this invite means you accept all the team rules.</span>
                        </p>
                        @elseif ($team->members->count() < 5)
                        <p>
                            @if ($request)
                            You have requested to join this team.
                            @else
                            <a href="{!! URL::route('request_team', [$team]) !!}" class="button button-block button-large button-flat-action">Request to join</a>
                            <span class="text-light">The leader has no obligation to accept this request.</span>
                            @endif
                        </p>
                        @endif
                    @endif
                </div>
                @if ($isLeader)
                <hr/>
                <h3>Delete</h3>
                {!! Form::open(['route' => 'delete_team', 'class' => 'form']) !!}
                        <label for="delete">
                            <input type="checkbox" value="1" name="delete" id="delete"/>
                            I want to delete my team.
                        </label>
                {!! Form::submit('Delete team', ['class' => 'button button-block button-flat-caution']) !!}
                {!! Form::close() !!}
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
@stop
