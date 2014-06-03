<nav>
	<div class="grid-container">
		<div class="grid-15 tablet-grid-100 brand">
			<a href="/"><img src="https://cdn.mediacru.sh/PghQ0cj1j2YI.svg" height="50px" border="0" /></a>
            <div class="hide-on-desktop">
                <a href="#" id="nav-toggle">
                    <i class="fa fa-bars fa-3x"></i>
                </a>
            </div>
		</div>
		<div class="grid-85 tablet-grid-100 hide-on-mobile" id="nav-container">
			<ul class="nav-links">
				@foreach($nav['primary'] as $navItem)
				    <li @if($navItem->isActive()) class="active" @endif><a href="{{ $navItem->getUrl() }}">{{ $navItem->getTitle() }}</a></li>
				@endforeach
			</ul>
		</div>
	</div>
</nav>