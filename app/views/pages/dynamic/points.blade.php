@extends('layouts.master')
@section('content')
<div class="content-back">
	<div class="grid-container">
		<div class="grid-40">
			<p>Prizes for the winners of the contest are in the form of CurseForge points which are given out to all developers who sign up to the scheme (applies to BukkitDev, CurseForge and other sites). Developers with more popular projects will receive more points. We rely on point donations to form the contest prize. The more points given, the more we can give out to the winning developers.</p>
			<h3>So far, {{{ $totalCount }}} people have donated points.</h3>
		</div>
		<div class="grid-55 pull-right text-center">
			<p>Points can be sent by using the <a href="http://store.curseforge.com">CurseForge store</a> and transferring to
				the 'tenjava' user.
			</p>
			<img src="/assets/img/points.png" />
		</div>
	</div>
</div>
<div class="grid-container">
	<div class="grid-100">

	</div>
</div>
@stop