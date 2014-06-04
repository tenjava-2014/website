@extends('layouts.master')
@section('content')
<div class="content-back">
	<div class="grid-container">
		<div class="grid-100 grid-parent">
			<h2>Why sign up?</h2>
			<div class="grid-80">
				<h3>Share your creation</h3>
				<p>By taking part in the contest and committing your code into the GitHub repository we create for you,
					you'll be helping others learn by example. Additionally, we encourage contest winners to consider
					making their entry into a full project and uploading it to somewhere like <a
						href="http://dev.bukkit.org">BukkitDev</a>. In this way, the contest benefits the development
					community by contributing more open-source code. Additionally, server admins will have additional
					plugins available to them. Last year, we had some very creative concepts, and we feel it's important
					that these plugins are shared with the community.</p>
			</div>
			<div class="grid-20 hide-on-mobile signup-image">
				<img src="/assets/img/thirdparty/share.svg">
			</div>
		</div>
		<div class="grid-100 grid-parent">
			<div class="grid-20 hide-on-mobile signup-image">
				<img src="/assets/img/thirdparty/trophy.svg">
			</div>
			<div class="grid-80">
				<h3>Points</h3>
				<p>We've already raised {{ number_format($pointsData->points) }} CurseForge points, which is equivalent
					to ${{ number_format($pointsData->points * 0.05, 2) }}. By participating, you have the chance to win
					a share of the prize pot. We're splitting the pot in portions of 50%, 30%, and 20% to first, second,
					and third, respectively. Points can be cashed out via PayPal or redeemed as Amazon gift cards, so
					it's definitely worth getting involved!</p>
			</div>
		</div>
		<div class="grid-100 grid-parent">
			<div class="grid-80">
				<h3>Learn something new</h3>
				<p>It's our hope that all participants will learn something new in the process of developing their
					submission. Judges (and hopefully other spectators) will be watching streams and offering
					advice on code, ideas, and more. We're also trying to ensure all participants get some exposure to
					an automated build tool (e.g. Maven) by preparing a common template that will be pushed to all
					repositories.</p>
			</div>
			<div class="grid-20 hide-on-mobile signup-image">
				<img src="/assets/img/thirdparty/book.svg">
			</div>
		</div>
		<div class="grid-100 grid-parent">
			<div class="grid-20 hide-on-mobile signup-image">
				<img src="/assets/img/thirdparty/happy.svg">
			</div>
			<div class="grid-80">
				<h3>Have fun</h3>
				<p>Above all, we're hoping ten.java will be a fun experience for everyone involved. We enjoyed judging
					the entries last year and seeing everything that the participants came up with, and we are looking
					forward to doing the same on a larger scale this year. For participants, ten.java should be a chance
					to experiment and hopefully learn something in the process.</p>
			</div>
		</div>
	</div>
</div>
<div class="grid-container">
	<div class="grid-80">
		<h3>Sign up now!</h3>

		<p>Signing up takes 30 seconds. We'll take some details and contact you when it's time to choose a
			timeslot. Signing up is done via your GitHub account &ndash; you don't need to register or make an
			account. Simply click a button below, fill in the fields, and register.</p>

		<p><a href="/register/participant" class="button button-large button-flat-action">Register as
				Participant</a> <a href="/register/judge" class="button button-large button-flat-primary">Apply to Become a Judge</a></p>
		<small>Please review the privacy info available <a href="/privacy">here</a> before signing up.
		</small>
	</div>
	<div class="grid-20 hide-on-mobile signup-image signup-margin">
		<img src="/assets/img/thirdparty/rocket.svg">
	</div>
</div>
@stop
