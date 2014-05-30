<?php

View::composer(array('partials.nav'), function ($view){
	$view->with('nav', BaseController::getNavigation());
});