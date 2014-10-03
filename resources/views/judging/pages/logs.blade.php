@extends('layouts.judging')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h1>Log viewer</h1>
            <p>This page allows you to view a real-time feed of your test server's log file.</p>
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