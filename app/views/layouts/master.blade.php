<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>ten.java 2014!</title>
	<link rel="icon" type="image/png" href="/assets/img/favicon.ico" />
	<link href="/assets/css/grid.css" rel="stylesheet" />
	<link href="/assets/css/styles.css" rel="stylesheet" />
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
</head>
<body>
<div id="wrapper">
	<nav>
		<div class="grid-container">
			<div class="grid-30 brand">
				<a href="#"><img src="https://cdn.mediacru.sh/PghQ0cj1j2YI.svg" height="50px" border="0" /></a>
			</div>
			<div class="grid-70">
				<ul class="nav-links">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#">Signup</a></li>
					<li><a href="#">Points</a></li>
					<li><a href="#">Judges</a></li>
					<li><a href="#">About</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div id="point-ticker">
		<div class="grid-container">
			<div class="grid-20 tablet-grid-20">Latest Donation: <span>alkarinv (2500)</span></div>
			<div class="grid-20 tablet-grid-20">Top Donation: <span>alkarinv (2500)</span></div>
			<div class="grid-20 tablet-grid-20">Total Points: <span>9348 ($433.56)</span></div>
			<div class="grid-20 tablet-grid-20">Last Signup: <span>jkcclemens</span></div>
			<div class="grid-20 tablet-grid-20">Total Signups: <span>122 developers</span></div>
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
			<ul class="social-media pull-right">
				<li><a href="mailto:contact@tenjava.com"><i class="fa fa-2x fa-envelope-square"></i></a></li>
				<li><a  title="" target="_blank" href="https://github.com/tenjava"><i class="fa fa-2x fa-github-square"></i></a></li>
				<li><a  target="_blank" href="https://twitter.com/tenjava"><i class="fa fa-2x fa-twitter-square"></i></a></li>
			</ul>
		</div>
	</div>
</footer>
</body>
</html>
