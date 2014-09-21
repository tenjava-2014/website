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
        $emails = $this->getEmails();
        $subscription = Subscription::where('gh_id', $this->auth->getUserId())->first();
        return Response::view('pages.forms.news', ['subscription' => $subscription, 'emails' => null]);
    }

    private function getEmails() {
        $old_emails = array_filter($this->auth->getEmails(), function ($email) {
            return !ends_with($email, '@users.noreply.github.com');
        });
        $emails = [];
        foreach ($old_emails as $email) {
            $emails[$email] = $email;
        }
        return $emails;
    }

    public function subscribe() {
        $validator = Validator::make(Input::all(), [
            'email' => 'required|email|unique:subscriptions,email'
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $email = Input::get('email');
        if (!in_array($email, $this->getEmails())) {
            return Redirect::back()->withErrors(['Invalid email.'])->withInput();
        }
        $subscription = new Subscription();
        $subscription->gh_id = $this->auth->getUserId();
        $subscription->gh_username = $this->auth->getUsername();
        $subscription->email = $email;
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
