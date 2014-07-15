@extends('layouts.judging')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h1>Feedback</h1>
            <p>This page shows all feedback submitted by participants.</p>
            @foreach ($feedbacks as $item)
                <blockquote class="feedback">
                    <p>{{{ $item->comment }}}</p>
                    <span class="username"><a href="/list/search?search={{{ $item->participant->gh_username }}}">{{{ $item->participant->gh_username }}}</a>, <span title="{{{ $item->created_at }}}">{{{ $item->created_at->diffForHumans() }}}</span></span>
                </blockquote>
            @endforeach

            <div class="text-center">{{ $feedbacks->links() }}</div>
        </div>
    </div>
</div>
@stop
