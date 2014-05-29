@extends('layouts.master')
@section('content')
<div id="header">
	<div class="grid-container">
		<div class="grid-100 text-center">
            Unofficial 10 hour Bukkit plugin contest.
        </div>
	</div>
</div>
<div class="content-back">
	<div class="grid-container">
		<div class="grid-60">
			<p><strong>ten.java</strong> is an unofficial, bi-annual Bukkit plugin development contest. Created in early
				November by nkrecklow with the first ever contest taking place on the 7th December 2013, ten.java is a
				ten hour competition to create an original plugin based on a theme. Plugins are judged by a group of
				volunteers and we use CurseForge points to award prizes to the winning developers. Last year we had just
				under 90 registered participants.</p>

			<p>This time we're hoping to see even more people participating. We've set a provisional date of <strong>July
					12th</strong> for this year's first event. If you're interested in getting involved as a
				participant, please signup below. The only thing you need is a GitHub account (to commit your code) and
				a BukkitDev account (to receive your points if you win). You can also apply to be a judge below.</p>

			<p>When you use the signup buttons, you'll be redirected to GitHub to authorise the application. We ask GitHub for an
				email so that we can contact you if you win (this info will not be shared and will be used for the sole purpose
				of communications directly related to the contest). We also use the API to retrieve your GitHub username. This
				username is used to create a repository on the tenjava github account and then added to the newly-created repo
				with full
				access.
				If you're unwilling to provide an email at any stage, please click <a href="/no-email">here</a> and then signup
				normally.
			</p>
		</div>
		<div class="grid-30 mobile-grid-100 tablet-grid-100 pull-right text-center">
			<p>
				<a href="#" class="button button-large button-block button-flat-action">Register as Participant</a>
				<span class="text-light">There are currently 123 participants</span>
			</p>
			<p>
				<a href="#" class="button button-block button-flat-primary">Apply to Become a Judge</a>
				<span class="text-light">There are currently 10 judges</span>
			</p>
			<p>
				<a href="#" class="button button-block button-flat-highlight">Make a Donation</a>
				<span class="text-light">We've raised 10000 points! That's a whopping $500!</span>
			</p>
		</div>
	</div>
</div>
<div class="grid-container">
	<div class="grid-20 mobile-grid-20 tablet-grid-20 twitch">
		<div class="twitch-snapshot">
			<img src="http://static-cdn.jtvnw.net/previews-ttv/live_user_nightblue3-600x400.jpg" width="100%" />
		</div>
		<div class="twitch-footer">
			lol768's stream
		</div>
	</div>
	<div class="grid-20 mobile-grid-20 tablet-grid-20 twitch">
		<div class="twitch-snapshot">
			<img src="http://static-cdn.jtvnw.net/previews-ttv/live_user_tsm_theoddone-600x400.jpg" width="100%" />
		</div>
		<div class="twitch-footer">
			lol768's stream
		</div>
	</div>
	<div class="grid-20 mobile-grid-20 tablet-grid-20 twitch">
		<div class="twitch-snapshot">
			<img src="http://static-cdn.jtvnw.net/previews-ttv/live_user_vgbootcamp-600x400.jpg" width="100%" />
		</div>
		<div class="twitch-footer">
			lol768's stream
		</div>
	</div>
	<div class="grid-20 mobile-grid-20 tablet-grid-20 twitch">
		<div class="twitch-snapshot">
			<img src="http://static-cdn.jtvnw.net/previews-ttv/live_user_riotgames-600x400.jpg" width="100%" />
		</div>
		<div class="twitch-footer">
			lol768's stream
		</div>
	</div>
	<div class="grid-20 mobile-grid-20 tablet-grid-20 twitch">
		<div class="twitch-snapshot">
			<img src="http://static-cdn.jtvnw.net/previews-ttv/live_user_nightblue3-600x400.jpg" width="100%" />
		</div>
		<div class="twitch-footer">
			lol768's stream
		</div>
	</div>
	<!--
<div class="grid-100 text-right">
<small><a href="#">View all streamers</a></small>
</div>
-->
</div>
@stop