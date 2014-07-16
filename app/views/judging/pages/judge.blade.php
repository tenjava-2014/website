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
            {{ Form::judgeField("Theme conformance", "idea_theme_conformance", 30) }}
            {{ Form::judgeField("Complexity", "idea_complexity", 10) }}
            {{ Form::judgeField("Fun/usefulness", "idea_fun", 10) }}
            {{ Form::judgeField("Expansion potential", "idea_expansion", 10) }}
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
