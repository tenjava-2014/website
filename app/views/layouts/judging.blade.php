<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>{{{ $titleAdd or "ten.java" }}}</title>
	<link rel="icon" type="image/png" href="{{ asset('/assets/img/favicon.ico') }}" />
	<link href="{{ asset('/assets/css/grid.css') }}" rel="stylesheet" />
	<link href="{{ asset('/assets/css/styles.css') }}?v=1.12" rel="stylesheet" />
    <script type="application/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.0/fastclick.min.js"></script>
    @yield('additional-scripts')
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">
	<meta name="description" content="Ten hour Bukkit plugin development contest." />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
</head>
<body class="judge-interface">
<div id="wrapper">
	@include('partials.nav', array("judgeLogo" => true))
	<div id="point-ticker">
		<div class="grid-container">
			<div class="grid-20 tablet-grid-20">Actual participants: <span>0</span></div>
			<div class="grid-20 tablet-grid-20">Turnout: <span>0</span></div>
			<div class="grid-20 tablet-grid-20">Assigned entries: <span>{{{ $claims['total'] }}}</span></div>
			<div class="grid-20 tablet-grid-20">Completed entries: <span>{{{ count($claims['done']) }}}</span></div>
			<div class="grid-20 tablet-grid-20">Entries remaining: <span>{{{ count($claims['pending']) }}}</span></div>
		</div>
	</div>
	@yield('content')
	<div class="push"></div>
</div>
@include('partials.footer')
<script type="application/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@yield('post-scripts')
<script type="application/javascript" src="{{ asset('/assets/js/time-circles.js') }}"></script>
<script type="application/javascript" src="{{ asset('/assets/js/jquery.timediff.min.js') }}"></script>
<script type="application/javascript" src="{{ asset('/assets/js/app.js?v=1.1') }}"></script>
</body>
</html>
