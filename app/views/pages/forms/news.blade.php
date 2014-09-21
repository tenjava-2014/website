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
            <p>
                You can subscribe to news about the upcoming ten.java contest here. If you subscribe, you will receive
                periodic emails from the ten.java team about the next ten.java contest! You can unsubscribe at any time.
            </p>
            @if ($subscription === null)
            {{ Form::open(array('url' => '/subscribe', 'class' => 'form')) }}
            <div class="control-group">
                <label for="email">Email</label>
                <div class="control">
                @if ($emails === null || count($emails) < 1)
                <div class="alert basic error">
                    We don't have access to any of your GitHub emails! Please specify an email to send mail to below.
                </div>
                {{ Form::text('email', null, array('placeholder' => 'me@example.com', 'id' => 'email')) }}
                @else
                {{ Form::select('email', $emails, null, array('id' => 'email')) }}
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
