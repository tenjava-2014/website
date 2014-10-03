<nav>
	<div class="grid-container">
		<div class="grid-15 tablet-grid-15 mobile-grid-100 brand">
			<a href="/"><img src="{{ (isset($judgeLogo)) ? asset('/assets/img/logo_judge.svg') : ((app()->env == 'prod') ? asset('/assets/img/logo_light.svg') : asset('/assets/img/logo_light_beta.svg')) }}" id="main-logo" alt="ten.java logo" /></a>
            <div class="hide-on-desktop hide-on-tablet">
                <a href="#" id="nav-toggle">
                    <i class="fa fa-bars fa-3x"></i>
                </a>
            </div>
		</div>
		<div class="grid-85 tablet-grid-85 mobile-grid-100 hide-on-mobile" id="nav-container">
			<ul class="nav-links">
				@foreach($nav['primary'] as $navItem)
				    <li @if($navItem->isActive()) class="active" @endif><a href="{{ $navItem->getUrl() }}">{{ $navItem->getTitle() }}</a></li>
				@endforeach
			</ul>
		</div>
	</div>
</nav>