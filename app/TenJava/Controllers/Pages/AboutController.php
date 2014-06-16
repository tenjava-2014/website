<?php
namespace TenJava\Controllers\Pages;

use Response;
use TenJava\Controllers\Abstracts\BaseController;

class AboutController extends BaseController {

    public function showAbout() {
        $this->setPageTitle("About");
        $this->setActive("about");
        return Response::view('pages.static.about', array());
    }

} 