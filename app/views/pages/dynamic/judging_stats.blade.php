@extends('layouts.master')
@section('additional-scripts')
<script type="application/javascript" src="{{ asset('/assets/js/Chart.min.js') }}"></script>
@stop
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Judging stats</h2>

            <p>As part of our desire to be transparent. we're making judging statistics public so you can track our
                progress. There's a few things to keep in mind with this data. Some judges may have different numbers of
                assigned plugins for a number of reasons. If judges discover a potentially rule-breaking submission or a
                plugin which requires advanced setup, they can flag it for review which removes it from their queue and
                assigns it to jkcclemens to sort out. Additionally, hawkfalcon is away and unable to judge.</p>

            <p>Judging began on July 17th 2014 with each submission set to be judged by two unique judges.</p>

            @foreach ($judges as $judge)
                <?php
                $i = 0;
                foreach ($judge->claims as $claim) {
                    if ($claim->result != null) {
                        $i++;
                    }
                }
                $totalAssigned = $judge->claims()->count();
                $x = $totalAssigned - $i;
                if ($totalAssigned == 0) {
                    $per = 100;
                } else {
                    $per = (floatval($i) / $totalAssigned) * 100;
                    $per = (int) $per;
                }
                ?>
                <!-- forgive me -->
                <div class="judge-progress" style="width: 100%; background-color: #aaa; padding: 0;">
                    <div style="margin: 0; background-color: #3590E6; width: {{{ $per }}}%; padding: 0;">
                        <h3 style="white-space: nowrap; margin: 0; padding: 5px; color: #fff;">{{{ $judge->github_name }}} ({{{ $i }}}/{{{ $totalAssigned }}})</h3></div>
                </div>
            @endforeach
            <h2>Next steps</h2>
            <p>Once everyone above has judged their submissions, we'll review the scores to ensure they've been awarded fairly and then use the scores to determine the winners. We'll then announce these results via a livestream.</p>
        </div>
    </div>
</div>
@stop
@section('post-scripts')
<script type="application/javascript" src="{{ asset('/assets/js/charts.js') }}"></script>
@stop