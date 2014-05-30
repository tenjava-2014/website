<?php


class AboutController extends BaseController {

    public function showAbout() {
        $this->setPageTitle("About");
        $this->setActive("about");
        return Response::view('pages.static.about', array());
    }

} 