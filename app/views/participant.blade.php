@extends('layout')

@section('content')
<div class="three centered columns">
    <p><img id="logo" src="/assets/img/drawing_1.svg"></p>
</div>
<div class="twelve columns" id="intro">
   <h2>Hey {{ $user }}!</h2>
    <p>You wanna be a participant :D</p>
</div>
@stop