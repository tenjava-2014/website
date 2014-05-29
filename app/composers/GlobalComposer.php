<?php

class GlobalComposer {

    public function compose($view) {
        $view->with('pointsData', []);
    }

}