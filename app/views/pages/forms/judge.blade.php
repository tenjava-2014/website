@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Apply to be a judge</h2>
            <div class="alert basic success">
                <button class="dismiss">×</button>
                <p><b>Done:</b> Process completed successfully</p>
            </div>
            <p>Please fill out the following fields to register for the 2014 ten.java contest.</p>
            <form class="form" action="/apply/participant">
                <div class="control-group">
                    <label for="bukkitdev">BukkitDev username</label>
                    <div class="control">
                        <input id="bukkitdev" type="text" value="{{{ $username }}}" name="dbo">
                    </div>
                </div>
                <div class="control-group">
                    <label for="twitch">twitch.tv username <span class="optional">(optional)</span></label>
                    <div class="control">
                        <input id="twitch" type="text" value="{{{ $username }}}" name="twitch">
                    </div>
                </div>
                <input type="submit" value="Sign up" class="button button-block button-flat-primary">
            </form>
        </div>
    </div>
</div>
@stop