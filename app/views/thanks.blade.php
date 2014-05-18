@extends('layout')

@section('content')
<div class="three centered columns">
    <p><a href="/"><img id="logo" src="/assets/img/drawing_1.svg"></a></p>
</div>
<div class="twelve columns" id="intro">
    <p>Thanks, your application has been received.</p>
    @if(isset($repo))
        <p>As you've applied to be a participant, we've made you a repository <a href="http://github.com/tenjava/{{{ $repo }}}">here</a>. Feel free to commit a README with a link to your stream URL, forums profile etc but please <strong>don't write any code until the starting time</strong>.</p>
    @else
        <p>As you've applied to be a judge, we'll contact you soon if your application was successful.</p>
    @endif
</div>
@stop