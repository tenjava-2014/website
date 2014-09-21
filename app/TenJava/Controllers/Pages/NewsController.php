<?php namespace TenJava\Controllers\Pages;

use TenJava\Controllers\Abstracts\BaseController;

class NewsController extends BaseController {

    public function __construct() {
        $this->beforeFilter('AuthenticationFilter');
    }

    public function showSubscribePage() {
        $emails = $this->auth->getEmails();
        return Response::view('pages.forms.news', ['emails' => $emails]);
    }

}
