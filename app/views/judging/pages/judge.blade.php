@extends('layouts.judging')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-80">
            <h1>Judging {{{ $claim->repo_name }}}</h1>

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
            <div class="control-group">
                <label for="comment">Liked phrase</label>
                <div class="control">
                    <textarea name="comment" id="comment">{{{ Input::old('feedback') }}}</textarea>
                </div>
            </div>
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
