<?php
namespace TenJava\Http\Controllers\Pages;

use TenJava\Http\Controllers\Abstracts\BaseController;
use Response;

class PrivacyController extends BaseController {

    public function showPrivacyInfo() {
        $this->setPageTitle("Privacy info");
        return Response::view('pages.static.privacy');
    }

}
