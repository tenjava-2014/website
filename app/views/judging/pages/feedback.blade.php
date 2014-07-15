@extends('layouts.judging')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h1>Feedback</h1>
            <p>This page shows all feedback submitted by participants.</p>
            @foreach ($feedbacks as $item)
                <p>{{{ $item->comment }}} from {{{ $item->participant->gh_username }}}</p>
            @endforeach
        </div>
    </div>
</div>
@stop
