<?php namespace TenJava\Controllers\Pages;

use Input;
use Redirect;
use Response;
use TenJava\Controllers\Abstracts\BaseController;
use TenJava\Models\Subscription;
use Validator;

class NewsController extends BaseController {

    public function showSubscribePage() {
        $this->setPageTitle('Subscribe to ten.java news');
        $emails = array_filter($this->auth->getEmails(), function ($email) {
            return !ends_with($email, '@users.noreply.github.com');
        });
        $subscription = Subscription::where('gh_id', $this->auth->getUserId())->first();
        return Response::view('pages.forms.news', ['subscription' => $subscription, 'emails' => $emails]);
    }

    public function subscribe() {
        $validator = Validator::make(Input::all(), [
            'email' => 'required|email|unique:subscriptions,email'
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $subscription = new Subscription();
        $subscription->gh_id = $this->auth->getUserId();
        $subscription->gh_username = $this->auth->getUsername();
        $subscription->email = Input::get('email');
        $subscription->save();
        return Redirect::back();
    }

    public function unsubscribe() {
        $subscription = Subscription::where('gh_id', $this->auth->getUserId())->first();
        if ($subscription === null) {
            return Redirect::back()->withErrors(['You are not subscribed to receive emails.']);
        }
        $subscription->delete();
        return Redirect::back();
    }

}
