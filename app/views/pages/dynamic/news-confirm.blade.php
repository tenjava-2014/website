@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            @if ($valid)
            <h2>Email Confirmed!</h2>
            <p>You've confirmed your email! You'll begin to receive updates on the upcoming ten.java contest soon.</p>
            @else
            <h2>Oops!</h2>
            <p>Something happened, and your email couldn't be confirmed. Try clicking the confirmation link again.</p>
            @endif
        </div>
    </div>
</div>
@stop
