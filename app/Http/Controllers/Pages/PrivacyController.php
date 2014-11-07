<?php
namespace TenJava\Http\Controllers\Pages;

use Auth;
use Response;
use TenJava\Http\Controllers\Abstracts\BaseController;

class PrivacyController extends BaseController {

    public function showPrivacyInfo() {
        $this->setPageTitle("Privacy info");
        return Response::view('pages.static.privacy');
    }

}
