<?php
namespace TenJava\Http\Controllers\Pages;

use Response;
use TenJava\Http\Controllers\Abstracts\BaseController;

class AboutController extends BaseController {

    public function showAbout() {
        $this->setPageTitle("About");
        $this->setActive("about");
        return Response::view('pages.static.about', array());
    }

}
