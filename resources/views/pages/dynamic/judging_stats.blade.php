@extends('layouts.master')
@section('additional-scripts')
<script type="application/javascript" src="{{ asset('/assets/js/Chart.min.js') }}"></script>
@stop
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Judging stats</h2>

            <div class="alert basic">
                <strong>We're working on reviewing inconsistent scores right now!</strong>
                <p>Now that judging is finished, we're hard at work reviewing all of the assigned scores for inconsistencies. We've identified about 130 of these (~ 10% of all scores allocated) and are working to check each one to ensure all entries are judged fairly. Your patience is appreciated!</p>
            </div>

            <p>As part of our desire to be transparent. we're making judging statistics public so you can track our
                progress. There's a few things to keep in mind with this data. Some judges may have different numbers of
                assigned plugins for a number of reasons. If judges discover a potentially rule-breaking submission or a
                plugin which requires advanced setup, they can flag it for review which removes it from their queue and
                assigns it to jkcclemens to sort out. Additionally, hawkfalcon is away and unable to judge.</p>

            <p>Judging began on July 17th 2014 with each submission set to be judged by two unique judges.</p>

            @foreach ($judges as $judge)
                <!-- forgive me -->
                <div class="judge-progress" style="width: 100%; background-color: #aaa; padding: 0;">
                    <div style="margin: 0; background-color: {{ $judge_progress[$judge->github_name]['finished'] ? "#7DB500" : "#3590E6" }}; width: {{{ $judge_progress[$judge->github_name]['percent'] }}}%; padding: 0;">
                        <h3 style="white-space: nowrap; margin: 0; padding: 5px; color: #fff;">{{{ $judge->github_name }}} ({{{ $judge_progress[$judge->github_name]['completed'] }}}/{{{ $judge_progress[$judge->github_name]['assigned'] }}})</h3>
                    </div>
                </div>
            @endforeach
            <h2>Overall progress</h2>
            <p>Please note that 100% completion of entries is not the only pre-requisite for results to be announced. We need to check scores allocated and prepare the site before announcing the results.</p>
            <div class="judge-progress" style="width: 100%; background-color: #aaa; padding: 0;">
                <div style="margin: 0; background-color: {{ $total_progress['finished'] ? "#7DB500" : "#3590E6" }}; width: {{{ $total_progress['percent'] }}}%; padding: 0;">
                    <h3 style="white-space: nowrap; margin: 0; padding: 5px; color: #fff;">{{{ $total_progress['percent'] }}}% ({{{ $total_progress['completed_claims'] }}}/{{{ $total_progress['total_claims'] }}})</h3>
                </div>
            </div>
            <h2>Next steps</h2>
            <p>Once everyone above has judged their submissions, we'll review the scores to ensure they've been awarded fairly and then use the scores to determine the winners. We'll then announce these results via a livestream.</p>
        </div>
    </div>
</div>
@stop
@section('post-scripts')
<script type="application/javascript" src="{{ asset('/assets/js/charts.js') }}"></script>
@stop