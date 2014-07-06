<div class="grid-container">
    <h3>Recent commits</h3>
    @foreach ($commits as $entry)
    <div class="grid-20 mobile-grid-20 tablet-grid-20">
        <div class="grid-100 time"><a href="http://www.github.com/tenjava/{{{ $entry->repo }}}">$entry->repo</a> &ndash; <span title="{{{ $entry->created_at }}}">{{{ $entry->created_at->diffForHumans() }}}</span></div>
        <div class="grid-100">
            <div class="content-back">
                <a href="https://www.github.com/tenjava/{{{ $entry->repo }}}/commit/{{{ $entry->hash }}}">{{{ $entry->message }}}</a>
            </div>
        </div>
    </div>
    @endforeach
</div>