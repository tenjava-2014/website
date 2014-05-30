<div class="grid-container">
	<div class="grid-100">
        <ul>
            @foreach ($tweets as $tweet)
                <li>{{{ Twitter::linkify($tweet['text']) }}}</li>
            @endforeach
            </ul>
	</div>
</div>