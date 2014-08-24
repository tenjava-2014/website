@extends('layouts.judging')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h1>Results viewer for {{{ $relevantClaims[0]->repo_name }}}</h1>
            <div class="alert basic error">
                <strong>This page is restricted.</strong>
                <p>This data should not be disclosed to judges, participants or the public under any circumstances.</p>
            </div>

            <p>
                This page is designed to be used by organizers in order to quickly review the assigned scores and notes
                given for a specific participant. This will be of use during the review process.
            </p>

            @foreach ($relevantClaims as $claim)
                <h2>Claim from {{ $claim->judge->github_name }}</h2>
                <p>This claim was created {{ BladeHelpers::prettyDate($claim->created_at) }}. The attached result was created {{ BladeHelpers::prettyDate($claim->result->created_at) }}.</p>
                @unless(object_get($claim, "result.internal_notes") == null)
                    <h3>Internal notes</h3>
                    <blockquote class="feedback">
                        <p> {{ object_get($claim, "result.internal_notes") }}</p>
                    </blockquote>
                @endunless
                <h3>Positive comment</h3>
                <blockquote class="feedback">
                    <p> {{ object_get($claim, "result.liked") }}</p>
                </blockquote>
                <h3>Improvement comment</h3>
                <blockquote class="feedback">
                    <p> {{ object_get($claim, "result.improve") }}</p>
                </blockquote>
                <h3>Point scores</h3>
                <ul>
                    @foreach ($columns as $column)
                        <li>{{{ $column }}}: {{{ object_get($claim, "result.$column") }}}</li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
</div>
@stop
