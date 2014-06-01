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
            <p>Please fill out the following fields to apply as a judge</p>

            <form class="form" action="/apply/participant">
                <div class="control-group">
                    <label for="bukkitdev">BukkitDev username</label>

                    <div class="control">
                        <input id="bukkitdev" type="text" value="{{{ $username }}}" name="dbo">
                    </div>
                </div>
                <div class="control-group">
                    <label for="minecraft">Minecraft username</label>

                    <div class="control">
                        <input id="minecraft" type="text" value="{{{ $username }}}" name="minecraft">
                    </div>
                </div>
                <div class="control-group">
                    <label for="irc" title="IRC is our primary communication medium.">IRC (EsperNet) nick</label>

                    <div class="control">
                        <input id="irc" type="text" name="irc" value="{{{ $username }}}">
                    </div>
                </div>
                <div class="control-group">
                    <label for="gmail" title="We'll use this for adding you to google drive files.">GMail/Google Apps address</label>

                    <div class="control">
                        <input id="gmail" type="text" name="gmail">
                    </div>
                </div>
                <input type="submit" value="Apply" class="button button-block button-flat-primary">
            </form>
        </div>
    </div>
</div>
@stop