<?php namespace TenJava\Util;

use Auth;
const GITHUB_NOREPLY_EMAIL = '@users.noreply.github.com';

class EmailUtil {

    public static function getInputEmails() {
        $emails = static::getEmails();
        $input_emails = [];
        foreach ($emails as $email) {
            $input_emails[$email] = $email;
        }
        return $input_emails;
    }

    /**
     * @return array
     */
    public static function getEmails() {
        /** @var \TenJava\User $user */
        $user = Auth::user();
        return static::removeNoReplyEmails($user->getEmails());
    }

    /**
     * @param array $emails The emails array to remove no-reply addresses from.
     * @return array The cleaned array.
     */
    public static function removeNoReplyEmails(array $emails) {
        $old_emails = array_filter($emails, function ($email) {
            return !ends_with($email, GITHUB_NOREPLY_EMAIL);
        });
        return $old_emails;
    }

}
