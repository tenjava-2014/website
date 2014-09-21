<?php
namespace TenJava\QueueJobs;

use Illuminate\Mail\Message;
use Illuminate\Queue\Jobs\Job;
use Mail;
use TenJava\Models\Subscription;
use TenJava\Security\HmacCreationInterface;
use TenJava\Security\HmacVerificationInterface;

class SendMailJob {

    public function __construct(HmacCreationInterface $hmacCreationInterface, HmacVerificationInterface $hmacVerificationInterface) {
        $this->hmacCreator = $hmacCreationInterface;
        $this->hmacVerifier = $hmacVerificationInterface;
    }

    public function fire(Job $job, $data) {
        $template = $data['template'];
        $gh_id = $data['gh_id'];
        $subject = $data['subject'];
        $subscription = Subscription::where('gh_id', $gh_id)->first();
        $send_data = static::getData($subscription);
        if (isset($data['hmac']) && $data['hmac']) {
            $send_data['hmac'] = $this->hmacCreator;
        }
        if ($subscription !== null) {
            Mail::send($template, $send_data, function (Message $message) use ($subscription, $subject) {
                $message->to($subscription->email, $subscription->gh_username)->subject($subject)->from('no-reply@tenjava.com', 'The ten.java Team');
            });
        }
        $job->delete();
    }

    public static function getData(Subscription $recipient) {
        return [
            'name' => $recipient->gh_username,
            'id' => $recipient->gh_id,
            'email' => $recipient->email
        ];
    }

}
