@extends('layouts.judging')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-80">
            <h1>Judging {{{ $claim->repo_name }}}</h1>
            <p>Please judge plugins as objectively as possible.
                You should be referring to our internal judging document while reviewing this submission.
                If you think the entry needs to be disqualified or you have other concerns, please request oversight.</p>

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
            <!--!-------------------!-->
            <legend>Idea (75 points)</legend>
            {{ Form::judgeField("Originality", "idea_originality", 15) }}
            <div class="control-group">
                <label for="idea_theme_conformance">Theme conformance (30 points)</label>
                <div class="control">
                    {{ Form::text('idea_theme_conformance', null, ['id' => 'idea_theme_conformance']) }}
                </div>
            </div>
            <div class="control-group">
                <label for="idea_complexity">Complexity (10 points)</label>
                <div class="control">
                    {{ Form::text('idea_complexity', null, ['id' => 'idea_complexity']) }}
                </div>
            </div>
            <div class="control-group">
                <label for="idea_fun">Fun/usefulness (10 points)</label>
                <div class="control">
                    {{ Form::text('idea_fun', null, ['id' => 'idea_fun']) }}
                </div>
            </div>
            <div class="control-group">
                <label for="idea_expansion">Expansion potential (10 points)</label>
                <div class="control">
                    {{ Form::text('idea_expansion', null, ['id' => 'idea_expansion']) }}
                </div>
            </div>
            <!--!-------------------!-->
            <div class="control-group">
                <label for="liked">Liked phrase</label>
                <div class="control">
                    {{ Form::text('liked', null, ['id' => 'liked_phrase', 'placeholder' => Lang::get("judging.input-helps.liked")]) }}
                </div>
            </div>
            <div class="control-group">
                <label for="improve">Improvement phrase</label>
                <div class="control">
                    {{ Form::text('improve', null, ['id' => 'improve', 'placeholder' => Lang::get("judging.input-helps.improve")]) }}
                </div>
            </div>
            <!--!-------------------!-->
            <input type="submit" value="Send" class="button button-block button-flat-primary">
            {{ Form::close() }}

        </div>
        <div class="grid-20">
            <h2>Cat picture :3</h2>
            <?php
            $width = rand(600,700);
            $height = $width / 6;
            $height *= 4;
            ?>
            <img src="http://placekitten.com/{{ (int) $width }}/{{ (int) $height }}" style="width: 100%;">
        </div>
    </div>
</div>
@stop
