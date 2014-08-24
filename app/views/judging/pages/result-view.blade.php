@extends('layouts.judging')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h1>Administrator results viewer</h1>
            <p>This page is designed to be used by organizers in order to quickly review the assigned scores and notes given for a specific participant.
            This will be of use during the review process.</p>

            <div class="alert basic error">This page is restricted.
                <p>This data should not be disclosed to judges, participants or the public under any circumstances.</p>
            </div>

            {{{ count($relevantClaims) }}}

        </div>
    </div>
</div>
@stop
