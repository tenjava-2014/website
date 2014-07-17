@extends('layouts.judging')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h1>Log viewer</h1>
            <p>This page allows you to view a realtime feed of your test server's log file. See a blank space? Your browser is blocking mixed content loading. Please ensure your traffic is not subject to an ongoing MiTM attack, enable mixed content loading and disable once you are finished with the log viewer.</p>
            <div class="server-details log-viewer">
            <pre id="logs">Log viewer app v0.1\n--------------------\nChecking for JS...</pre>
            </div>
        </div>
        
    </div>
</div>
@stop
@section('post-scripts')
<script type="application/javascript" src="{{ asset('/assets/js/log-viewer.js') }}"></script>
@stop
