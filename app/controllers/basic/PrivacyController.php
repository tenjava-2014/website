<?php


class PrivacyController extends BaseController {

    public function showPrivacyInfo() {
        $this->setPageTitle("Privacy info");
        return Response::view('pages.static.privacy', array("emailOptOut" => false));
    }

} 