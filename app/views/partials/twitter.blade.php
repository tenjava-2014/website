<div class="grid-container">
	<div class="grid-100">
		<h3>Tweets from {{ Twitter::linkify('@tenjava') }}</h3>
	</div>
	@foreach ($tweets as $tweet)
	<div class="grid-20 grid-parent">
		<div class="content-back">
			<div class="grid-100 time">{{ Twitter::ago($tweet['created_at']) }}</div>
			<div class="grid-100">{{ Twitter::linkify($tweet['text']) }}</div>
		</div>
	</div>
	@endforeach
</div>