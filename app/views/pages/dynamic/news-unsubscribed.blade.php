@extends('layouts.master')
@section('content')
<div class="grid-container">
    <div class="grid-100">
        @if ($valid)
        <h2>Unsubscribed!</h2>
        <p>
            You've successfully unsubscribed from the updates about ten.java. If you want to subscribe again, you can do
            so at any time <a href="/subscribe">here</a>.
        </p>
        @else
        <h2>Oops!</h2>
        <p>
            Something happened, and you couldn't be unsubscribed. Try following the link again, or contact us if this
            keeps happening.
        </p>
        @endif
    </div>
</div>
@stop
