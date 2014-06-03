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
	<div class="grid-100">
		<h2>Join the Team</h2>
		<p>ten.java would not be able to function without our dedicated panel of judges, developers, and organisers. We are always looking for rmore talented individuals to aid in development and growth of ten.java. If you would like to join the team, <a href="/register/judge">apply to be a judge using Github</a>.
		</p>
		<p><a href="/register/judge" class="button button-large button-flat-primary">Register as
				Judge</a></p>
		<small>Please review the privacy info available <a href="/privacy">here</a> before signing up.
			</small>
	</div>
</div>
@stop