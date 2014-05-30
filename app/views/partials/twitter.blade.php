<div class="grid-container">
	<div class="grid-100">
		@foreach ($tweets as $tweet)
		<div class="grid-20">{{ Twitter::linkify($tweet['text']) }}</div>
		@endforeach
	</div>
</div>