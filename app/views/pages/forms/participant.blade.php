@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Sign up as participant</h2>
            <p>Please fill out the following fields to register for the 2014 ten.java contest.</p>

            @if ($errors->any())
                <div class="alert block error">
                    <h4>Registration errors</h4>
                    <ul>
                        @foreach($errors->all('<li>:message</li>') as $message)
                            {{ $message }}
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ Form::open(array('url' => '/apply/participant', 'class' => 'form')) }}
                <div class="control-group">
                    <label for="bukkitdev">BukkitDev username</label>
                    <div class="control">
                        <input id="bukkitdev" type="text" value="{{{ Input::old('dbo', $username) }}}" name="dbo">
                    </div>
                </div>
                <div class="control-group">
                    <label for="twitch">twitch.tv username <span class="optional">(optional)</span></label>
                    <div class="control">
                        <input id="twitch" type="text" value="{{{ Input::old('twitch', $username) }}}" name="twitch">
                    </div>
                </div>
                <input type="submit" value="Sign up" class="button button-block button-flat-primary">
            {{ Form::close() }}

        </div>
    </div>
</div>
@stop