@extends('layouts.judging')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            @if (isset($claim))
            <h2>Requesting oversight on {{{ $claim->repo_name }}}</h2>
            <p>Please provide a detailed explanation of why you are requesting oversight for this submission so we can easily investigate what is going on and get it sorted.</p>
            @if ($errors->any())
            <div class="alert block error">
                <h4>Judging errors</h4>
                <ul>
                    @foreach($errors->all('<li>:message</li>') as $message)
                    {{ $message }}
                    @endforeach
                </ul>
            </div>
            @endif

            {{ Form::open(array('class' => 'form')) }}
            <input type="hidden" name="claim_id" value="{{{ $claim->id }}}">
            <div class="control-group">
                <label for="comment">Comments</label>
                <div class="control">
                    <textarea name="comment" id="comment">{{{ Input::old('comment') }}}</textarea>
                </div>
            </div>
            <input type="submit" value="Send feedback" class="button button-block button-flat-primary">
            @else
            <h2>Requesting oversight</h2>

            <p>If while judging a plugin you do not think it can be judged or you have concerns about <a
                    href="https://github.com/tenjava/resources/wiki/Contest-Rules">rule</a> violations, you'll need to
                request oversight. Requesting oversight will hide the plugin in question from your claims list while the
                matter is looked into by an organizer.</p>

            <p>We can easily re-assign the entry to you, so don't hesitate to use this functionality if you have any
                doubt. The best-case scenario is that we find no issues and re-assign the entry &ndash; you can't be too
                cautious. </p>

            <h2>Example reasons for oversight</h2>

            <p>The following is a non-conclusive list of some potentially common issues that may require an oversight
                request:</p>
            <ul>
                <li>No substantial changes have been made to the actual template repo (<a
                        href="https://github.com/tenjava/chasechocolate-t3/">example</a>)
                </li>
                <ul>
                    <li>If the plugin's README contains documentation of an idea (but no code changes), you should score
                        the idea category and give zero for the remaining two categories. Please explain you have done
                        this in the
                        internal notes section.
                    </li>
                </ul>
                <li>You are concerned about the use of external (or copy-pasted) libraries or dependencies.</li>
                <li>You believe part of the plugin's code was written outside the timeslot.</li>
                <li>You believe a plugin is malicious.</li>
                <li>You believe an issue on our end impaired your ability to judge the plugin.</li>
            </ul>

            <h2>Scenarios where internal notes are more appropriate</h2>

            <p>In addition to the oversight system, judges can leave notes while judging a plugin. These notes should be
                used if you are in a situation where you are able to award some points to a plugin but difficulties were
                encountered. Examples:</p>
            <ul>
                <li>The plugin was well-documented and included code changes but unfortunately did not load. In this
                    case, you should judge the applicable sections (e.g. idea and code) and leave a note as to the
                    reasoning behind the rest of the points.
                </li>
                <li>The plugin caused the server to crash so you were unable to fully test it.</li>
            </ul>
            @endif
        </div>


    </div>
</div>
@stop
