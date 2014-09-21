@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Get Contest News</h2>
            {{ Form::open(array('url' => '/subscribe', 'class' => 'form')) }}
            <div class="control-group">
                <label for="email">Email</label>
                <div class="control">
                @if ($emails === null)
                <div class="alert basic error">
                    We don't have access to any of your GitHub emails! Please specify an email to send mail to below.
                </div>
                {{ Form::input('email', null, array('placeholder' => 'me@example.com')) }}
                @else
                {{ Form::select('email', $emails) }}
                @endif
                </div>
            </div>
            <input type="submit" value="Subscribe" class="button button-block button-flat-primary">
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop
