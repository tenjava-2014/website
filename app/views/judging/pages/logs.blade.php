@extends('layouts.judging')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h1>Log viewer</h1>
            <p>This page allows you to view a realtime feed of your test server's log file.</p>
            <div class="server-details" id="logs">Checking for JS...</div>
        </div>
    </div>
</div>
@stop
@section('post-scripts')
<script type="application/javascript" src="{{ asset('/assets/js/log-viewer.js') }}"></script>
@stop