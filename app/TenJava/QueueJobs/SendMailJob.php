<?php
namespace TenJava\QueueJobs;

use Illuminate\Mail\Message;
use Illuminate\Queue\Jobs\Job;
use Mail;
use TenJava\Models\Subscription;

class SendMailJob {

    public function fire(Job $job, $data) {
        $template = $data['template'];
        $gh_id = $data['gh_id'];
        $subject = $data['subject'];
        $subscription = Subscription::where('gh_id', $gh_id)->first();
        $send_data = static::getData($subscription);
        if (isset($data['data'])) {
            $send_data = array_merge($send_data, $data['data']);
        }
        if ($subscription !== null) {
            Mail::send($template, $send_data, function (Message $message) use ($subscription, $subject) {
                $message->to($subscription->email, $subscription->gh_username)->subject($subject)->from('no-reply@tenjava.com', 'The ten.java Team');
            });
        }
        $job->delete();
    }

    public static function getData(Subscription $subscription) {
        return [
            'name' => $subscription->gh_username,
            'id' => $subscription->gh_id,
            'email' => $subscription->email,
            'subscription_id' => $subscription->id
        ];
    }

}
