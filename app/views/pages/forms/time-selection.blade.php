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

            <ul>
                <li>Time 1 (best for AU). Starts at <span class="date-replacer" data-time="1405123200"
                                                          title="2014-07-12 00:00:00 UTC">2014-07-12 00:00:00 UTC</span>
                    and ends at <span class="date-replacer" title="2014-07-12 10:00:00 UTC" data-time="1405159200">2014-07-12 10:00:00 UTC</span>.
                </li>
                <li>Time 2 (best for EU). Starts at <span class="date-replacer" data-time="1405155600"
                                                          title="2014-07-12 09:00:00 UTC">2014-07-12 09:00:00 UTC</span>
                    and ends
                    at <span class="date-replacer" data-time="1405191600" title="2014-07-12 19:00:00 UTC">2014-07-12 19:00:00 UTC</span>.
                </li>
                <li>Time 3 (best for US). Starts at <span class="date-replacer" data-time="1405173600"
                                                          title="2014-07-12 14:00:00 UTC">2014-07-12 14:00:00 UTC</span>
                    and ends
                    at <span class="date-replacer" data-time="1405209600" title="2014-07-13 00:00:00 UTC">2014-07-13 00:00:00 UTC</span>.
                </li>
            </ul>

            <p>Please choose the competition time(s) for the <strong>{{{ $username }}}</strong> user. It is recommended
                that all
                participants stick to 1 time only. That said, it is feasible to participate in both time 1 and an
                additional time for those interested.</p>

            <p class="time-indicator display-none">Please note that all times are displayed in your computer's timezone.
                If you'd like to see UTC times, please hover over the times.</p>

            @if ($errors->any())
            <div class="alert block error">
                <h4>Form errors</h4>
                <ul>
                    @foreach($errors->all('
                    <li>:message</li>
                    ') as $message)
                    {{ $message }}
                    @endforeach
                </ul>
            </div>
            @endif

            @if (!$existing)
            {{ Form::open(array('url' => '/times/confirm', 'class' => 'form')) }}
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

            @else

            <p>You have already selected the following times:</p>
            <ul>
                @if ($existing->t1) <li>Time 1</li> @endif
                @if ($existing->t2) <li>Time 2</li> @endif
                @if ($existing->t3) <li>Time 3</li> @endif
            </ul>
            <p>Contact an organizer to get your selection changed<p>

            @endif

        </div>
    </div>
</div>
@stop