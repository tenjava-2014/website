@extends('layouts.master')
@section('content')
<div class="grid-container">
    <h2>Scores for your entries</h2>
    <p>
        This page contains the averaged score data for your ten.java entries. You might not have any scores here if you
        didn't take part or your entry was disqualified.
    </p>
    @foreach ($times as $time)
        <h2>{{{ $time }}}</h2>
        @if (array_key_exists($time, $data))
            <?php $cur = $data[$time]; dd($cur); ?>
            <p>
                This entry was awarded a total of <strong>{{{ $cur['results']['total'] }}}</strong> points by our judging team and
                places {{{ $cur['place'] . ordinal($cur['place']) }}} out of all judged entries.
            </p>
            <p>
                Here's a quick summary of what our judging team liked about this entry:
            </p>
            @foreach ($cur['liked'] as $msg)
                <div class="feedback">
                    <p>{{{ $msg  }}}</p>
                </div>
            @endforeach

            <p>And here's what we thought could be improved:</p>
            @foreach ($cur['improve'] as $msg)
                <div class="feedback">
                    <p>{{{ $msg  }}}</p>
                </div>
            @endforeach
        @else
            <p>
               We don't have any applicable score data for this entry. If you think we should, please contact us with
               the link in the footer.
            </p>
        @endif
    @endforeach
    <p></p>
</div>
@stop
@section('post-scripts')
<script type="application/javascript" src="{{ asset('/assets/js/charts.js') }}"></script>
@stop