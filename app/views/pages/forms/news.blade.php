@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            @if ($errors->any())
            <div class="alert block error">
                <h4>Request errors</h4>
                <ul>
                    @foreach($errors->all('<li>:message</li>') as $message)
                    {{ $message }}
                    @endforeach
                </ul>
            </div>
            @endif
            <h2>Get Contest News</h2>
            @if ($subscription === null)
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
            @else
            <p>
                You have already subscribed for news with the email <em>{{{ $subscription->email }}}</em>. If you would
                like to, you can unsubscribe below.
            </p>
            {{ Form::open(array('url' => '/unsubscribe', 'class' => 'form')) }}
                <input type="submit" value="Unsubscribe" class="button button-block button-flat-primary"/>
            {{ Form::close() }}
            @endif
        </div>
    </div>
</div>
@stop
