<?php

View::composer('*', 'GlobalComposer');

View::composer(array('partials.nav'), function ($view){
	$view->with('nav', BaseController::getNavigation());
});