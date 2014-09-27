<footer>
	<div class="grid-container">
		<div class="grid-80 tablet-grid-50 mobile-grid-100">
			<p>Site licensed under <a href="https://github.com/tenjava/website/blob/master/LICENSE">GPLv3</a>.<br />
				ten.java is not affiliated with Bukkit or Mojang in any way. <br />
                <a href="/privacy">Privacy info</a>@if (!$auth->isLoggedIn()) :: <a href="/login">Login</a>@else  :: <a href="/logout">Logout</a>@endif
            </p>
		</div>
		<div class="grid-20 tablet-grid-50 mobile-grid-100">
			<ul class="soc-links">
				<li><a href="mailto:{{{ HTML::obfuscate('tenjava@' . 'ten' . 'java.com') }}}"><i class="fa fa-2x fa-envelope-square"></i></a></li>
				<li><a title="" target="_blank" href="https://github.com/tenjava"><i class="fa fa-2x fa-github-square"></i></a></li>
				<li><a target="_blank" href="https://twitter.com/tenjava"><i class="fa fa-2x fa-generic-bird-square"></i></a></li>
				<li><a target="_blank" href="http://forums.bukkit.org/threads/269253/"><span class="fa-stack bottom"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-comment fa-stack-1x black"></i></span></a></li>
			</ul>
		</div>
	</div>
</footer>