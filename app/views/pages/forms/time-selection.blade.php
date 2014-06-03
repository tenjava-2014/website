@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Select a time</h2>

            <div class="alert basic warning">
                <p><b>Warning!</b> Once you have chosen a time you will need to contact an organizer to get your
                    selection changed. Think carefully before committing!</p>
            </div>
            <p>As per last year, we have multiple timeslots which will each be assigned a separate theme. Unlike last
                year, we have made a few changes to how things work. This year, ten.java will happen at 3 different
                times.</p>

            <!-- will be released soon! -->
            <p>Please choose the competition time(s) for the <strong>{{{ $username }}}</strong> user. It is recommended
                that all
                participants stick to 1 time only. That said, it is feasible to participate in both time 1 and an
                additional time for those interested.</p>

            <p class="time-indicator display-none">Please note that all times are displayed in your computer's timezone. If you'd like to see UTC times, please hover over the times.</p>

            @if ($errors->any())
                <div class="alert block error">
                    <h4>Application errors</h4>
                    <ul>
                        @foreach($errors->all('<li>:message</li>') as $message)
                            {{ $message }}
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ Form::open(array('url' => '/time/confirm', 'class' => 'form')) }}
                <div class="control-group">
                    <p class="label">Please select one of these options</p>
                    <ul class="control unstyled">
                        <li><input type="radio" id="rb1" name="rb" value="t1"><label for="rb1">Time 1</label></li>
                        <li><input type="radio" id="rb2" name="rb" value="t2"><label for="rb2">Time 2</label></li>
                        <li><input type="radio" id="rb3" name="rb" value="t3"><label for="rb3">Time 3</label></li>
                        <li><input type="radio" id="rb4" name="rb" value="t1t2"><label for="rb4" class="optional">Time 1
                                and Time 2</label></li>
                        <li><input type="radio" id="rb5" name="rb" value="t1t3"><label for="rb5" class="optional">Time 1
                                and Time 3</label></li>
                    </ul>
                </div>

                <input type="submit" value="Confirm selection" class="button button-block button-flat-primary">
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop