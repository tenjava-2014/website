<?php
namespace TenJava\Controllers\Pages;

use TenJava\Controllers\Abstracts\BaseController;

class PrivacyController extends BaseController {

    public function showPrivacyInfo() {
        $this->setPageTitle("Privacy info");
        return Response::view('pages.static.privacy');
    }

} 