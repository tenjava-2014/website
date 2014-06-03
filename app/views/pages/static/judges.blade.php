@extends('layouts.master')
@section('content')
<div class="content-back">
	<div class="grid-container">
		@foreach (Config::get("user-access.present") as $key => $values)
		<div class="grid-100">
			<h2>{{{ $key }}}</h2>
		</div>
		<?php $i = 0; ?>
		@foreach ($values as $value)
		@include("partials.team-entry", array("username" => $value))
		<?php $i++; ?>
		@endforeach
		@endforeach
	</div>
</div>
<div class="grid-container">
	<h3>Join the Team!</h3>
</div>
@stop