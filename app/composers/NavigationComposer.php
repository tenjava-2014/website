<?php

class NavigationComposer {

    public function compose($view) {
        $view->with('nav', BaseController::getNavigation());
    }

}