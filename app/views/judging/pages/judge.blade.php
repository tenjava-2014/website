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
            <legend>Execution (75 points)</legend>
            {{ Form::judgeField("User friendliness", "execution_user_friendliness", 20) }}
            {{ Form::judgeField("Absence of bugs", "execution_absence_bugs", 20) }}
            {{ Form::judgeField("General plugin mechanics", "execution_general_mechanics", 35) }}
            <!--!-------------------!-->
            <legend>Code (100 points)</legend>
            {{ Form::judgeField("Bukkit API use", "code_bukkit_api", 40) }}
            {{ Form::judgeField("General Java use", "code_java", 40) }}
            {{ Form::judgeField("Documentation", "code_documentation", 20) }}
            <!--!-------------------!-->
            <legend>PR</legend>
            <p>Do not include prefixes like "We liked" or "We thought" or "We suggest" in these phrases! These prefixes will automatically be inserted for you.</p>
            <div class="control-group">
                <label for="liked">Liked phrase</label>
                <div class="control">
                    {{ Form::text('liked', null, ['id' => 'liked', 'placeholder' => Lang::get("judging.input-helps.liked")]) }}
                </div>
            </div>
            <div class="control-group">
                <label for="improve">Improvement phrase</label>
                <div class="control">
                    {{ Form::text('improve', null, ['id' => 'improve', 'placeholder' => Lang::get("judging.input-helps.improve")]) }}
                </div>
            </div>
            <legend>Internal (hidden to participant)</legend>
            <div class="control-group">
                <label for="improve">Judging notes</label>
                <div class="control">
                    {{ Form::text('internal_notes', null, ['id' => 'internal_notes', 'placeholder' => "Optional"]) }}
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
            <h2>Actions</h2>
            <p><a href="/judging/oversight/{{{ $claim->id }}}" class="button button-flat-action button-block"><i class="fa-bell fa"></i> Request oversight</a></p>
            <p><a href="/judging/plugins/skip" class="button button-flat-action button-block"><i class="fa-forward fa"></i> Skip plugin</a></p>
            <p><a href="/judging/plugins/toggle" class="button button-flat-action button-block"><i class="fa-pencil fa"></i> Toggle input</a></p>
            <h2>Plugin links</h2>
            <p><a href="https://github.com/tenjava/{{{ $claim->repo_name }}}/" target="_blank" class="button button-flat-highlight button-block">GitHub repo</a></p>
            <p><a href="https://github.com/tenjava/{{{ $claim->repo_name }}}/commits" target="_blank" class="button button-flat-highlight button-block">GitHub commits</a></p>
            <p><a href="http://ci.tenjava.com/job/{{{ $claim->repo_name }}}/" target="_blank" class="button button-flat-highlight button-block">Jenkins Job</a></p>
            <p><a href="https://tenjava.com/list/search?search={{{ substr($claim->repo_name, 0, -3) }}}" target="_blank" class="button button-flat-highlight button-block">App search</a></p>
            <h2>Tips</h2>
            <ul>
                <li>Please remember to take breaks &ndash; don't try and judge all of your plugins at once. A couple a day is fine.</li>
                <li>Request oversight if you are unable to judge a plugin/concerned about rule-breaking to judge a plugin.</li>
                <li>For minor queries, contact an organizer in IRC.</li>
            </ul>
        </div>
    </div>
</div>
@stop
