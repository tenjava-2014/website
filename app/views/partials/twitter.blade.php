<div class="grid-container">
	<div class="grid-100">
		Tweets from {{ Twitter::linkify('@tenjava') }}
	</div>
	<div class="grid-100">
		@foreach ($tweets as $tweet)
		<div class="grid-20 grid-parent">
			<div class="grid-100">{{ Twitter::ago($tweet['created_at']) }}</div>
			<div class="grid-100">{{ Twitter::linkify($tweet['text']) }}</div>
		</div>
		@endforeach
	</div>
</div>