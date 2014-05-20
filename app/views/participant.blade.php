@extends('layout')

@section('title')
Applicant -
@stop


@section('content')
<div class="three centered columns">
    <p><a href="/"><img id="logo" src="/assets/img/drawing_1.svg"></a></p>
</div>
<div class="twelve columns" id="intro">
    <h2>Hey {{ $user }}!</h2>

    <p>Before we sign you up, we need a little more information from you. <strong>Note: If you don't want to stream or are unable to, just leave the box blank or fill it in with a username that does not exist.</strong> Thanks for getting involved!</p>
    @if ($noEmail)
    <p>You've opted out of sharing your email with us. We'll communicate with you via your BukkitDev account.</p>
    @endif
    {{ Form::open(array('url' => '/apply')) }}
        <fieldset>
            <legend>Additional information</legend>
            <ul>
                <li class="field">
                    <label class="inline" for="dbo">BukkitDev Username</label>
                    <input class="wide text input" id="dbo" name="dbo" type="text" value="{{{ $user }}}"/>
                </li>
                <li class="field">
                    <label class="inline" for="dbo">Twitch.tv Username (optional)</label>
                    <input class="wide text input" id="twitch" name="twitch" type="text" value="{{{ $user }}}"/>
                </li>
            </ul>
        </fieldset>
    <div class="medium metro rounded btn primary"><input type="submit" name="submit" value="Apply" id="register-submit"></div>    {{ Form::close() }}
    {{ Form::close() }}

    <small>By applying, you consent to us sending you information directly related to the contest via email and/or BukkitDev PM. Your email will not be shared with anyone.</small>
</div>
@stop