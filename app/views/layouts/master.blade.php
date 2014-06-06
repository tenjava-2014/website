<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>{{{ $titleAdd or "ten.java" }}}</title>
	<link rel="icon" type="image/png" href="/assets/img/favicon.ico" />
	<link href="/assets/css/grid.css" rel="stylesheet" />
	<link href="/assets/css/styles.css" rel="stylesheet" />
    <script type="application/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.0/fastclick.min.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">
	<meta name="description" content="Ten hour Bukkit plugin development contest." />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
</head>
<body>
<div id="wrapper">
	@include('partials.nav')
	<div id="point-ticker">
		<div class="grid-container">
			<div class="grid-20 tablet-grid-20">Latest Donation: <span>{{ $pointsData->recent_transactions{0}->username }} ({{ number_format($pointsData->recent_transactions{0}->amount) }} points)</span></div>
			<div class="grid-20 tablet-grid-20">Top Donation: <span>{{ $pointsData->better_top{0}->username }} ({{ number_format($pointsData->better_top{0}->amount) }} points)</span></div>
			<div class="grid-20 tablet-grid-20">Prize: <span>{{ number_format($pointsData->points) }} points (${{ number_format($pointsData->points * 0.05, 2) }})</span></div>
			<div class="grid-20 tablet-grid-20">Last Sign-up: <span>{{ $appsData->latestUsername }}</span></div>
			<div class="grid-20 tablet-grid-20">Total Sign-ups: <span>{{ $appsData->count }} participants</span></div>
		</div>
	</div>
	@yield('content')
	<div class="push"></div>
</div>
@include('partials.footer')
<script type="application/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="application/javascript">
$( document ).ready(function() {
    $("#nav-toggle").click(function() {
        $("#nav-container").toggleClass("hide-on-mobile");
    });
    $(".date-replacer").each(function() {
        var date = new Date($(this).data("time") * 1000);
        $(this).text(date.toString());
    });
});
</script>
</body>
</html>
