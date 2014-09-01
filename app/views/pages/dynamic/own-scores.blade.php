@extends('layouts.master')
@section('content')
<div class="grid-container">
    <h2>Feedback for your entries</h2>
    <p>
        This page contains the judge feedback and score info for your ten.java entries. You might not have any data here if you
        didn't take part or your entry was disqualified.
    </p>
    @foreach ($times as $time)
        <h2>{{{ $time }}}</h2>
        @if (array_key_exists($time, $data))
            <?php $cur = $data[$time]; ?>
            <p>
                This entry was awarded a total of <strong>{{{ $cur['results']['total'] }}}</strong> points by our judging team and
                places {{{ $cur['place'] . ordinal($cur['place']) }}} out of all judged entries.
            </p>
            <p>
                Here's a quick summary of what our judging team liked about this entry:
            </p>
            @foreach ($cur['liked'] as $msg)
                <blockquote class="feedback">
                    <p>{{{ $msg }}}</p>
                </blockquote>
            @endforeach

            <p>
                And here's what we thought could be improved:
            </p>
            @foreach ($cur['improve'] as $msg)
                <blockquote class="feedback">
                    <p>{{{ $msg }}}</p>
                </blockquote>
            @endforeach

            <p>
                Finally, here are the scores we awarded the entry for each major category:
            </p>

            <ul>
                <li>Idea: {{{ $cur['results']['idea'] }}} / 75</li>
                <li>Execution: {{{ $cur['results']['execution'] }}} / 75</li>
                <li>Code: {{{ $cur['results']['code'] }}} / 100</li>
            </ul>
        @else
            <p>
               We don't have any applicable score data for this entry. If you think we should, please contact us with
               the email link in the footer.
            </p>
        @endif
    @endforeach
    <p></p>
</div>
@stop
@section('post-scripts')
<script type="application/javascript" src="{{ asset('/assets/js/charts.js') }}"></script>
@stop