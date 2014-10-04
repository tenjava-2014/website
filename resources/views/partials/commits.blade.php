<div class="grid-container">
	<div class="grid-100">
		<h3>Recent commits</h3>
	</div>
    <div id="commitsInner">
        @foreach ($commits as $i => $entry)
        <div class="grid-20 mobile-grid-20 tablet-grid-20">
            <?php
            /** @noinspection PhpUndefinedVariableInspection */
            $entry->created_at->setTimezone('UTC');
            ?>
            <div class="grid-100 time"><a href="http://www.github.com/tenjava/{{ $entry->repo }}">{{ $entry->repo }}</a> &ndash; <span title="{{ $entry->created_at }}">{{ $entry->created_at->diffForHumans() }}</span></div>
            <div class="grid-100">
                <div class="content-back">
                    <a href="https://www.github.com/tenjava/{{ $entry->repo }}/commit/{{ $entry->hash }}">{{ $entry->message }}</a>
                </div>
            </div>
            @if ($i == 0)
            <div id="commitHash" data-hash="{{ $entry->hash }}"></div>
            @endif
        </div>
        @endforeach
    </div>
</div>
