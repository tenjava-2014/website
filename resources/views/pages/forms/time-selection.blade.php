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

            <p>Please choose the competition time(s) for the <strong>{{ $username }}</strong> user. It is recommended
                that all
                participants stick to 1 time only. That said, it is feasible to participate in both time 1 and an
                additional time for those interested.</p>

            <p class="time-indicator display-none">Please note that all times are displayed in your computer's timezone.
                If you'd like to see UTC times, please hover over the times.</p>

            @if ($errors->any())
            <div class="alert block error">
                <h4>Form errors</h4>
                <ul>
                    @foreach($errors->all('<li>:message</li>') as $message)
                        {!! $message !!}
                    @endforeach
                </ul>
            </div>
            @endif

            @if (!$existing)
            <div class="alert basic error">
                <p><b>Registrations closed.</b> Sorry, participant registrations are now closed. You are no longer able to choose a time.</p>
            </div>

            @else

            <p>You have already selected the following times:</p>
            <ul>
                @if ($existing->t1) <li>Time 1. Starts at <span class="date-replacer" data-time="1405123200"
                                                                title="2014-07-12 00:00:00 UTC">2014-07-12 00:00:00 UTC</span>
                    and ends at <span class="date-replacer" title="2014-07-12 10:00:00 UTC" data-time="1405159200">2014-07-12 10:00:00 UTC</span></li> @endif
                @if ($existing->t2) <li>Time 2. Starts at <span class="date-replacer" data-time="1405155600"
                                                                title="2014-07-12 09:00:00 UTC">2014-07-12 09:00:00 UTC</span>
                    and ends
                    at <span class="date-replacer" data-time="1405191600" title="2014-07-12 19:00:00 UTC">2014-07-12 19:00:00 UTC</span></li> @endif
                @if ($existing->t3) <li>Time 3. Starts at <span class="date-replacer" data-time="1405173600"
                                                      title="2014-07-12 14:00:00 UTC">2014-07-12 14:00:00 UTC</span>
                    and ends
                    at <span class="date-replacer" data-time="1405209600" title="2014-07-13 00:00:00 UTC">2014-07-13 00:00:00 UTC</span></li> @endif
            </ul>
            <p>Contact an <a href="/team">organizer</a> to get your selection changed.<p>

            @endif

        </div>
    </div>
</div>
@stop
