@extends('layouts.master')
@section('additional-scripts')
<script type="application/javascript" src="{{ asset('/assets/js/Chart.min.js') }}"></script>
@stop
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Judging stats</h2>
            <p>As part of our desire to be transparent. we're making judging statistics public so you can track our progress.</p>
            @foreach ($judges as $judge)
                <h3>{{{ $judge }}}</h3>
            @endforeach
        </div>
    </div>
</div>
@stop
@section('post-scripts')
<script type="application/javascript" src="{{ asset('/assets/js/charts.js') }}"></script>
@stop