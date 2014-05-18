@extends('layout')

@section('content')
<div class="three centered columns">
    <p><img id="logo" src="/assets/img/drawing_1.svg"></p>
</div>
<div class="twelve columns" id="intro">
    <h2>Hey {{ $user }}!</h2>

    <p>Before we sign you up, we need a little more information from you. Thanks for getting involved!</p>

    {{ Form::open(array('url' => '/apply')) }}
        <fieldset>
            <legend>Additional information</legend>
            <ul>
                <li class="field">
                    <label class="inline" for="dbo">BukkitDev Username</label>
                    <input class="wide text input" id="dbo" name="dbo" type="text" value="{{{ $user }}}"/>
                </li>
            </ul>
        </fieldset>
    <div class="medium metro rounded btn primary"><input type="submit" name="submit" value="Apply" id="register-submit"></div>    {{ Form::close() }}
    {{ Form::close() }}

    <small>By applying, you consent to us sending you information directly related to the contest via email and/or BukkitDev PM. Your email will not be shared with anyone.</small>
</div>
@stop