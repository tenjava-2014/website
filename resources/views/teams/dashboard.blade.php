@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="content-back">
        <div class="grid-container">
            <div class="grid-60">
                <h2>Teams</h2>
                @foreach ($allTeams as $a_team)
                    <p>
                        <a href="{!! URL::route('team', [$a_team->id]) !!}">{{ $a_team->name }}</a>
                        <span class="text-light">Lead by {{ $a_team->leader->username }}</span>
                    </p>
                @endforeach
            </div>
            <div class="grid-30 mobile-grid-100 tablet-grid-100 pull-right">
                <div class="text-center">
                    @if ($team)
                    <p>
                        <a href="{!! URL::route('team', [$team]) !!}" class="button button-block button-large button-flat-primary">View your team</a>
                        <span class="text-light">Takes you to your team page.</span>
                    </p>
                    @else
                    <p>
                        <a href="/teams/create" class="button button-block button-large button-flat-action">Create a team</a>
                        <span class="text-light">{{ $allTeams->count() }} {{ Str::plural('team', $allTeams->count()) }} already created.</span>
                    </p>
                    @endif
                </div>
                @if (!$team && $invites && $invites->count() > 0)
                <h2>Invites ({{ $invites->count() }})</h2>
                @foreach ($invites as $invite)
                @if ($invite->team->members->count() < 5)
                <p>
                    Invite from <a href="{!! URL::route('team', [$invite->team]) !!}">{{ $invite->team->name }}</a>.
                </p>
                @endif
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@stop
