@extends('layouts.master')
@section('content')
<div class="content-back">
    @foreach (Config::get("user-access.present") as $key => $values)
        <div class="grid-container">
            <h2>{{{ $key }}}</h2>
            <?php $i = 0; ?>
            @foreach ($values as $value)
                @include("partials.team-entry", array("username" => $value))
                <?php $i++; ?>
            @endforeach
        </div>
    @endforeach
</div>
@stop