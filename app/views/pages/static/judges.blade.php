@extends('layouts.master')
@section('content')
@foreach (Config::get("user-access.present") as $key => $values)

<h2>{{{ $key }}}</h2>
<?php $i = 0; ?>
@foreach ($values as $value)
@if($i % 2 > 0)
<div class="content-back">
	@endif
	<div class="grid-container">
		@include("partials.team-entry", array("username" => $value))
	</div>
	@if($i % 2 > 0)
</div>
@endif
<?php $i++; ?>
@endforeach
@endforeach
@stop