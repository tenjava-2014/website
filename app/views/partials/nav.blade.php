<nav>
	<div class="grid-container">
		<div class="grid-30 tablet-grid-100 brand">
			<a href="#"><img src="https://cdn.mediacru.sh/PghQ0cj1j2YI.svg" height="50px" border="0" /></a>
		</div>
		<div class="grid-70 tablet-grid-100">
			<ul class="nav-links">
				@foreach($nav['primary'] as $navItem)
				<li @if($navItem->isActive()) class="active" @endif><a href="{{ $navItem->getUrl() }}">{{ $navItem->getTitle() }}</a></li>
				@endforeach
			</ul>
		</div>
	</div>
</nav>