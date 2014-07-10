<div class="grid-container">
	<div class="grid-100">
		<h3>Online streamers</h3>
	</div>
    @foreach ($twitch as $entry
        <div class="grid-20 mobile-grid-20 tablet-grid-20 twitch">
            <div class="twitch-snapshot">
                <img src="http://static-cdn.jtvnw.net/previews-ttv/live_user_nightblue3-600x400.jpg">
            </div>
            <div class="twitch-footer">
                {{{ $entry->gh_username }}}'s stream
            </div>
        </div>
    @endforeach
	<div class="grid-100 text-right">
		<small><a href="/streams">View all streamers</a></small>
	</div>
</div>