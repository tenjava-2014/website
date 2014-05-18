@extends('layout')

@section('content')
<div class="three centered columns">
    <p><img id="logo" src="/assets/img/drawing_1.svg"></p>
</div>
<div class="twelve columns" id="intro">
    <h2>Hey {{ $user }}!</h2>

    <p>Before we sign you up, we need a little more information from you. Thanks for getting involved!</p>

    <p>Note: As a judge, you'll be responsible for scoring a share of the submissions. Judges will need to be able to
        connect to the EsperNet IRC network and will also need to be able to access the voting spreadsheet. Finally,
        you'll need a paid Minecraft account to test the plugins.</p>


    {{ Form::open(array('url' => '/apply')) }}
    <fieldset>
        <legend>Additional information</legend>
        <ul>
            <li class="field">
                <label class="inline" for="dbo">BukkitDev Username</label>
                <input class="wide text input" id="dbo" name="dbo" type="text" value="{{{ $user }}}"/>
            </li>
            <li class="field">
                <label class="inline" for="irc">IRC Nick</label>
                <input class="wide text input" id="irc" name="irc" type="text" value="{{{ $user }}}"/>
            </li>
            <li class="field">
                <label class="inline" for="mcign">Minecraft username</label>
                <input class="wide text input" id="mcign" name="mcign" type="text" value="{{{ $user }}}"/>
            </li>
            <li class="field">
                <label class="inline" for="gdocs">Google docs/gmail address</label>
                <input class="wide text input" id="gdocs" name="gdocs" type="text" value="{{{ $user }}}"/>
            </li>
        </ul>
    </fieldset>
    <div class="medium metro rounded btn primary"><input type="submit" name="submit" value="Apply" id="register-submit"></div>    {{ Form::close() }}


    <small>By applying, you consent to us sending you information directly related to the contest via email and/or
        BukkitDev PM. Your email will not be shared with anyone.
    </small>
</div>
@stop