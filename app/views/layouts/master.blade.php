<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>{{{ $titleAdd or "ten.java" }}}</title>
	<link rel="icon" type="image/png" href="{{ asset('/assets/img/favicon.ico') }}" />
	<link href="{{ asset('/assets/css/grid.css') }}" rel="stylesheet" />
	<link href="{{ asset('/assets/css/styles.css') }}?v=1.53" rel="stylesheet" />
    <script type="application/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.0/fastclick.min.js"></script>
    @yield('additional-scripts')
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">
	<meta name="description" content="Ten hour Bukkit plugin development contest." />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
</head>
<body>
<div id="wrapper">
	@include('partials.nav')
	<div id="point-ticker">
		<div class="grid-container">
			<div class="grid-25 tablet-grid-20">Latest Donation: <span>{{ $pointsData->recent_transactions{0}->username }} ({{ number_format($pointsData->recent_transactions{0}->amount) }} points)</span></div>
			<div class="grid-25 tablet-grid-20">Top Donation: <span>{{ $pointsData->better_top{0}->username }} ({{ number_format($pointsData->better_top{0}->amount) }} points)</span></div>
			<div class="grid-25 tablet-grid-20">Prize: <span>{{ number_format($pointsData->points) }} points (${{ number_format($pointsData->points * 0.05, 2) }})</span></div>
			<div class="grid-25 tablet-grid-20">Total Sign-ups: <span>{{ $appsData->count }} participants</span></div>
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
