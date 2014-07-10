<div class="grid-container">
	<div class="grid-100">
		<h3>Online streamers</h3>
	</div>
    @foreach ($twitch as $entry)
        <div class="grid-20 mobile-grid-20 tablet-grid-20 twitch">
            <div class="twitch-snapshot">
                <img src="{{{ str_replace(['{WIDTH}', '{HEIGHT}'], ['600', '400'], $entry->onlineStream->preview_template) }}}">
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