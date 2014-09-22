<?php namespace TenJava\Controllers\Pages;

use Config;
use Input;
use Queue;
use Redirect;
use Response;
use TenJava\Controllers\Abstracts\BaseController;
use TenJava\Models\Subscription;
use TenJava\Security\HmacCreationInterface;
use TenJava\Security\HmacVerificationInterface;
use Validator;

class NewsController extends BaseController {

    public function __construct(HmacCreationInterface $hmacCreationInterface, HmacVerificationInterface $hmacVerificationInterface) {
        parent::__construct();
        $this->hmacCreator = $hmacCreationInterface;
        $this->hmacVerifier = $hmacVerificationInterface;
    }

    public function showSubscribePage() {
        $this->setPageTitle('Subscribe to ten.java news');
        $emails = $this->getEmails();
        $subscription = Subscription::where('gh_id', $this->auth->getUserId())->first();
        return Response::view('pages.forms.news', ['subscription' => $subscription, 'emails' => $emails]);
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
        $emails = $this->getEmails();
        if (($emails !== null && count($emails) > 0) && !in_array($email, $emails)) {
            return Redirect::back()->withErrors(['Invalid email.'])->withInput();
        }
        $subscription = new Subscription();
        $subscription->gh_id = $this->auth->getUserId();
        $subscription->gh_username = $this->auth->getUsername();
        $subscription->email = $email;
        $subscription->save();
        Queue::push(
            '\\TenJava\\QueueJobs\\SendMailJob',
            [
                'gh_id' => $this->auth->getUserId(),
                'template' => 'emails.news.welcome',
                'subject' => 'Confirm Subscription to ten.java Updates!',
                'data' => [
                    'confirm_url' => 'https://tenjava.com/confirm/' . e($subscription->id) . '/' . e(static::getEmailHMAC($subscription))
                ]
            ]
        );
        return Redirect::back();
    }

    /**
     * @param Subscription $subscription
     * @return string
     */
    public function getEmailHMAC(Subscription $subscription) {
        parse_str($this->hmacCreator->createSignature($subscription->email, Config::get('gh-data.verification-key')), $output);
        return $output['sha1'];
    }

    public function unsubscribe() {
        $subscription = Subscription::where('gh_id', $this->auth->getUserId())->first();
        if ($subscription === null) {
            return Redirect::back()->withErrors(['You are not subscribed to receive emails.']);
        }
        $subscription->delete();
        return Redirect::back();
    }

    public function unsubscribeDirectly(Subscription $subscription, $sha1) {
        $valid = static::compareEmailHMAC($subscription, $sha1);
        if ($valid) {
            $subscription->delete();
        }
        return Response::view('pages.dynamic.news-unsubscribed', ['valid' => $valid]);
    }

    /**
     * @param Subscription $subscription
     * @param $sha1
     * @return bool
     */
    public function compareEmailHMAC(Subscription $subscription, $sha1) {
        return $this->hmacVerifier->verifySignature($subscription->email, $sha1, Config::get('gh-data.verification-key'));
    }

    public function confirm(Subscription $subscription, $sha1) {
        if ($subscription->confirmed) {
            return Response::view('pages.dynamic.news-confirm', ['valid' => true]);
        }
        $valid = static::compareEmailHMAC($subscription, $sha1);
        if ($valid) {
            $subscription->confirmed = true;
            $subscription->save();
        }
        return Response::view('pages.dynamic.news-confirm', ['valid' => $valid]);
    }

}
