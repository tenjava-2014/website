@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Verification Key</h2>
            <p>You've probably been told to visit this page by an organizer. If so, great! Please provide them with this key:</p>
            <pre>{{{ $key }}}</pre>
        </div>
    </div>
</div>
@stop