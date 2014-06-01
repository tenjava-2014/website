@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Apply to be a judge</h2>

            <div class="alert basic warning">
                <p><b>Warning!</b> Judge applications will be considered by the organisers. We need to see some form of
                    evidence (GitHub repos, BukkitDev plugins) to show you will be able to assess code quality
                    effectively. Your application will not be considered without this.</p>
            </div>
            <p>Please fill out the following fields to apply as a judge. We'll contact you soon after your application
                to let you know if we have decided to accept you or not. If your application is declined, you're free to
                register as a participant. Please note that successful judges cannot participate in the contest.</p>

            @if ($errors->any())
                <div class="alert block error">
                    <h4>Application errors</h4>
                    <ul>
                        @foreach($errors->all('<li>:message</li>') as $message)
                            {{ $message }}
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ Form::open(array('url' => '/apply/judge', 'class' => 'form')) }}
                <div class="control-group">
                    <label for="bukkitdev">BukkitDev username</label>

                    <div class="control">
                        <input id="bukkitdev" type="text" value="{{{ Input::old('dbo', $username) }}}" name="dbo">
                    </div>
                </div>
                <div class="control-group">
                    <label for="minecraft">Minecraft username</label>

                    <div class="control">
                        <input id="minecraft" type="text" value="{{{ Input::old('minecraft', $username) }}}" name="mcign">
                    </div>
                </div>
                <div class="control-group">
                    <label for="irc" title="IRC is our primary communication medium.">IRC (EsperNet) nick</label>

                    <div class="control">
                        <input id="irc" type="text" name="irc" value="{{{ Input::old('irc', $username) }}}">
                    </div>
                </div>
                <div class="control-group">
                    <label for="gmail" title="We'll use this for adding you to google drive files.">GMail/Google Apps
                        address</label>

                    <div class="control">
                        <input id="gmail" type="text" name="gdocs" value="{{{ Input::old('gdocs') }}}">
                    </div>
                </div>
                <input type="submit" value="Apply" class="button button-block button-flat-primary">
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop