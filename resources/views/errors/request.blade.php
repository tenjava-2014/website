@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Bad request</h2>
            <p>Your client submitted a bad request. The reason for this is:</p>
            <p><strong>{{ $reason }}</strong></p>
            <p>Please try again later or contact a member of the web team if the problem persists.</p>
        </div>
    </div>
</div>
@stop
