@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
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
            <h2>{{ $creating ? 'Create a' : 'Update' }} team</h2>
            <p>
                Do it here!
            </p>
            {!! Form::open(array('url' => $creating ? '/teams/create' : '/teams/update', 'class' => 'form')) !!}
            <div class="control-group">
                {!! Form::label('name', 'Team Name') !!}
                <div class="control">
                    {!! Form::text('name', $creating ? null : $team->name, ['id' => 'name', 'placeholder' => 'Jumping Jackrabbits']) !!}
                    <small><a href="javascript:generateName();">Generate</a></small>
                </div>
                {!! Form::label('description', 'Description') !!}
                <div class="control">
                    {!! Form::textarea('description', $creating ? null : $team->description, ['placeholder' => 'Some Markdown about this team here']) !!}
                </div>
                {!! Form::label('general_rules', 'General Rules') !!}
                <div class="control">
                    {!! Form::textarea('general_rules', $creating ? null : $team->general_rules, ['placeholder' => 'Some Markdown rules here']) !!}
                </div>
                {!! Form::label('prize_rules', 'Prize Rules') !!}
                <div class="control">
                    {!! Form::textarea('prize_rules', $creating ? null : $team->prize_rules, ['placeholder' => 'How will the prize be split? These are instructions to the organizers and information to members.']) !!}
                </div>
                {!! Form::label('miscellaneous_rules', 'Miscellaneous Rules') !!}
                <div class="control">
                    {!! Form::textarea('miscellaneous_rules', $creating ? null : $team->miscellaneous_rules, ['placeholder' => 'Some extra Markdown rules here']) !!}
                </div>
            </div>
            {!! Form::submit($creating ? 'Create team' : 'Update team', ['class' => 'button button-block button-flat-primary']) !!}
            @if ($creating)
            <span class="text-light">
                Creating a team will delete all outstanding requests and invites. By creating a team, you acknowledge
                that you agree to the <a href="{!! URL::route('terms') !!}">terms of service</a>.
            </span>
            @endif
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop

@section('post-scripts')
<script src="{!! asset('/assets/js/teams.js') !!}"></script>
@stop
