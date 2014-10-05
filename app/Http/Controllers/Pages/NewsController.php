<?php namespace TenJava\Http\Controllers\Pages;

use Auth;
use Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Input;
use Queue;
use Redirect;
use Response;
use TenJava\Http\Controllers\Abstracts\BaseController;
use TenJava\Security\HmacCreationInterface;
use TenJava\Security\HmacVerificationInterface;
use TenJava\Subscription;
use Validator;
use View;

const GITHUB_NOREPLY_EMAIL = '@users.noreply.github.com';

// TODO: Yell at lol768 for being a Nazi (blah blah blah SRP blah blah)
class NewsController extends BaseController {

    /**
     * @param HmacCreationInterface $hmacCreationInterface
     * @param HmacVerificationInterface $hmacVerificationInterface
     */
    public function __construct(HmacCreationInterface $hmacCreationInterface, HmacVerificationInterface $hmacVerificationInterface) {
        parent::__construct();
        $this->hmacCreator = $hmacCreationInterface;
        $this->hmacVerifier = $hmacVerificationInterface;
    }

    /**
     * @param Subscription $subscription
     * @param $sha1
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * @param Subscription $subscription
     * @param $sha1
     * @return bool
     */
    public function compareEmailHMAC(Subscription $subscription, $sha1) {
        return $this->hmacVerifier->verifySignature($subscription->email, $sha1, Config::get('gh-data.verification-key'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function resendConfirmationEmail() {
        $currentSubscription = $this->getCurrentSubscription();
        if ($currentSubscription === null || $currentSubscription->confirmed) {
            throw new ModelNotFoundException; // user got himself here
        }
        $this->sendConfirmationEmail($currentSubscription, $this->auth->getUserId());
        return Redirect::route('resend-thanks');
    }

    /**
     * @return Subscription|null
     */
    private function getCurrentSubscription() {
        // FIXME: SRP, extract to repo. interface w/ eloquent impl.
        return Subscription::query()->where('gh_id', Auth::user()->gh_id)->first();
    }

    /**
     * @param Subscription $subscription Subscription object to send confirmation for.
     * @param int $userId User's GitHub id.
     */
    private function sendConfirmationEmail($subscription, $userId) {
        // FIXME: SRP -> Extract to interface w/ impl.
        Queue::push(
            '\TenJava\QueueJobs\SendMailJob',
            [
                'gh_id' => $userId,
                'template' => 'emails.news.welcome',
                'subject' => 'Confirm Subscription to ten.java Updates!',
                'data' => [
                    'confirm_url' => 'https://tenjava.com/confirm/' . urlencode($subscription->id) . '/' . urlencode(static::getEmailHMAC($subscription))
                ]
            ]
        );
    }

    /**
     * @param Subscription $subscription
     * @return string
     */
    public function getEmailHMAC(Subscription $subscription) {
        parse_str($this->hmacCreator->createSignature($subscription->email, Config::get('gh-data.verification-key')), $output);
        return $output['sha1'];
    }

    /**
     * @return \Illuminate\View\View
     */
    public function showResendConfirmation() {
        $this->setPageTitle('Confirmation email resent');
        return View::make('pages.result.thanks.resend-confirmation', ['subscription' => $this->getCurrentSubscription()]);
    }

    /**
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function showSubscribePage() {
        $this->setPageTitle('Subscribe to ten.java news');
        // FIXME: SRP (move to own function)
        return Response::view('pages.forms.news', [
            'subscription' => $this->getSubscription(),
            'emails' => $this->getEmails()
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getSubscription() {
        $user = Auth::user();
        if ($user == null) return null;
        return Subscription::query()->where('gh_id', $user->gh_id)->first();
    }

    /**
     * @return array
     */
    public function getEmails() {
        return $this->removeNoReplyEmails(Auth::user()->getEmails());
    }

    /**
     * @param array $emails The emails array to remove no-reply addresses from.
     * @return array The cleaned array.
     */
    private function removeNoReplyEmails(array $emails) {
        // FIXME: Make util class for this.
        $old_emails = array_filter($emails, function ($email) {
            return !ends_with($email, GITHUB_NOREPLY_EMAIL);
        });
        return $old_emails;
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function subscribe() {
        // FIXME: SRP - not controller logic
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
        // FIXME: SRP - use repo. pattern w/ eloquent impl.
        $subscription = new Subscription();
        $subscription->gh_id = $this->auth->getUserId();
        $subscription->gh_username = $this->auth->getUsername();
        $subscription->email = $email;
        $subscription->save();
        $this->sendConfirmationEmail($subscription, $this->auth->getUserId());
        return Redirect::back();
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function unsubscribe() {
        $subscription = $this->getCurrentSubscription();
        if ($subscription === null) {
            return Redirect::back()->withErrors(['You are not subscribed to receive emails.']);
        }
        $subscription->delete();
        return Redirect::back();
    }

    /**
     * @param Subscription $subscription
     * @param $sha1
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function unsubscribeDirectly(Subscription $subscription, $sha1) {
        $valid = static::compareEmailHMAC($subscription, $sha1);
        if ($valid) {
            $subscription->delete();
        }
        return Response::view('pages.dynamic.news-unsubscribed', ['valid' => $valid]);
    }

}
