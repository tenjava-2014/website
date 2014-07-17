@extends('layouts.judging')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Requesting oversight</h2>

            <p>If while judging a plugin you do not think it can be judged or you have concerns about <a
                    href="https://github.com/tenjava/resources/wiki/Contest-Rules">rule</a> violations, you'll need to
                request oversight. Requesting oversight will hide the plugin in question from your claims list while the
                matter is looked into by an organizer.</p>

            <p>We can easily re-assign the entry to you, so don't hesitate to use this functionality if you have any
                doubt. The best-case scenario is that we find no issues and re-assign the entry &ndash; you can't be too cautious. </p>

            <h2>Example reasons for oversight</h2>
            <p>The following is a non-conclusive list of some potentially common issues that may require an oversight request:</p>
            <ul>
                <li>No substantial changes have been made to the actual template repo (<a href="https://github.com/tenjava/chasechocolate-t3/">example</a>)</li>
                <ul>
                    <li>If the plugin's README contains documentation of an idea, you should score the idea category and give zero for the remaining two categories.</li>
                    <li></li>
                </ul>
            </ul>
        </div>


    </div>
</div>
@stop
