@extends('layout')

@section('content')
<div class="three centered columns">
    <p><a href="/"><img id="logo" src="/assets/img/drawing_1.svg"></a></p>
</div>
<div class="twelve columns" id="intro">
    <h2>Error</h2>

    <p>Your application was rejected. The errors were:</p>
    <ul class="list">
        @foreach($messages->all('<li>:message</li>') as $message)
            {{ $message }}
        @endforeach
    </ul>

    <div class="medium metro rounded btn primary">
        <a href="/">Try again</a>
    </div>
</div>
@stop
