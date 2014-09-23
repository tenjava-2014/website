@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>We've resent your confirmation email</h2>
            <p>Please check your <em>{{{ $subscription->email }}}</em> email account and follow the instructions in the
            email we sent you. Be sure to check your spam folder if you can't see our confirmation email.</p>

            <p>If you still need help, send us an email or contact us in IRC.</p>
        </div>
    </div>
</div>
@stop