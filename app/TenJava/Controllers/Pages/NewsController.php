<?php namespace TenJava\Controllers\Pages;

use TenJava\Controllers\Abstracts\BaseController;
use Response;

class NewsController extends BaseController {

    public function showSubscribePage() {
        $this->setPageTitle('Subscribe to ten.java news');
        $emails = $this->auth->getEmails();
        return Response::view('pages.forms.news', ['emails' => $emails]);
    }

}
