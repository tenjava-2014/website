<?php namespace TenJava\Controllers\Pages;

use Response;
use TenJava\Controllers\Abstracts\BaseController;
use TenJava\Models\Subscription;

class NewsController extends BaseController {

    public function showSubscribePage() {
        $this->setPageTitle('Subscribe to ten.java news');
        $emails = array_filter($this->auth->getEmails(), function ($email) {
            return !ends_with($email, '@users.noreply.github.com');
        });
        $subscription = Subscription::where('gh_id', $this->auth->getUserId())->first();
        return Response::view('pages.forms.news', ['subscription' => $subscription, 'emails' => $emails]);
    }

}
