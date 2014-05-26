@extends('layout')

@section('title')
Thanks -
@stop


@section('content')
<div class="three centered columns">
    <p><a href="/"><img id="logo" src="/assets/img/drawing_1.svg"></a></p>
</div>
<div class="twelve columns" id="intro">
    <p>Thanks, your application has been received.</p>
    @if(isset($repo))
        <p>As you've applied to be a participant, we'll make you a repository soon. You'll be able to select a timeslot soon too.</p>
    @else
        <p>As you've applied to be a judge, we'll contact you soon if your application was successful.</p>
    @endif
</div>
@stop
