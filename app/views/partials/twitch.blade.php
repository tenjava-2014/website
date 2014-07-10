<div class="@if (!isset($full))grid-container@endif">
    @if (!isset($full))
        <div class="grid-100">
            <h3>Online streamers</h3>
        </div>
    @endif
    @foreach ($twitch as $entry)
        <div class="grid-20 mobile-grid-20 tablet-grid-20 twitch">
            <div class="twitch-snapshot">
                <a href="https://twitch.tv/{{{ $entry->twitch_username }}}"><img src="{{{ str_replace(['{WIDTH}', '{HEIGHT}'], ['600', '400'], $entry->onlineStream->preview_template) }}}"></a>
            </div>
            <div class="twitch-footer">
                {{{ $entry->gh_username }}}'s stream
            </div>
        </div>
    @endforeach
    @if (!isset($full))
        <div class="grid-100 text-right">
            <small><a href="/streams">View all streamers</a></small>
        </div>
    @endif
</div>