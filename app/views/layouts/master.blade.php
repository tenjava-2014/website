<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>{{{ $titleAdd }}}</title>
	<link rel="icon" type="image/png" href="/assets/img/favicon.ico" />
	<link href="/assets/css/grid.css" rel="stylesheet" />
	<link href="/assets/css/styles.css" rel="stylesheet" />
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">
    <meta name="description" content="Ten hour Bukkit plugin development contest." />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
</head>
<body>
<div id="wrapper">
	@include('partials.nav')
	<div id="point-ticker">
		<div class="grid-container">
			<div class="grid-20 tablet-grid-20">Latest Donation: <span>{{ $pointsData->recent_transactions{0}->username }} ({{ number_format($pointsData->recent_transactions{0}->amount) }})</span></div>
			<div class="grid-20 tablet-grid-20">Top Donation: <span>{{ $pointsData->better_top{0}->username }} ({{ number_format($pointsData->better_top{0}->amount) }})</span></div>
			<div class="grid-20 tablet-grid-20">Total Points: <span>{{ number_format($pointsData->points) }} (${{ number_format($pointsData->points * 0.05, 2) }})</span></div>
			<div class="grid-20 tablet-grid-20">Last Signup: <span>{{ $appsData->latestUsername }}</span></div>
			<div class="grid-20 tablet-grid-20">Total Signups: <span>{{ $appsData->count }} developers</span></div>
		</div>
	</div>
	@yield('content')
	<div class="push"></div>
</div>
<footer>
	<div class="grid-container">
		<div class="grid-80">
			<p>&copy; 2014 ten.java - All Rights Reserved.<br />
				ten.java (competition and website) is not affiliated with Bukkit, Curse, or Mojang in any way.</p>
		</div>
		<div class="grid-20">
			<ul class="social-media">
				<li><a href="mailto:contact@tenjava.com"><i class="fa fa-2x fa-envelope-square"></i></a></li>
				<li><a title="" target="_blank" href="https://github.com/tenjava"><i class="fa fa-2x fa-github-square"></i></a></li>
				<li><a target="_blank" href="https://twitter.com/tenjava"><i class="fa fa-2x fa-twitter-square"></i></a></li>
                <li><a target="_blank" href="http://forums.bukkit.org/threads/269253/"><i class="fa fa-2x fa-comments"></i></a></li>
            </ul>
		</div>
	</div>
</footer>
</body>
</html>
