@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <p>Points!</p>

            <p>So far, {{{ $totalCount }}} people have donated points.</p>
        </div>
    </div>
</div>
@stop