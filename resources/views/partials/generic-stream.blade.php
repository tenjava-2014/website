<div>
    @foreach ($streams as $entry)
        <div class="grid-20 mobile-grid-20 tablet-grid-20 twitch">
            <div class="twitch-snapshot">
                <a href="{!! $entry['url'] !!}"><img src="{!! $entry['preview'] !!}"></a>
            </div>
            <div class="twitch-footer">
                {!! $entry['username'] !!}'s stream
            </div>
        </div>
    @endforeach
</div>
