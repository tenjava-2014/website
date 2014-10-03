<?php namespace TenJava\Socialite;

use Laravel\Socialite\Two\GithubProvider;
use Laravel\Socialite\Two\User;

class GithubEmailProvider extends GithubProvider {

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token) {
        return array_merge(parent::getUserByToken($token), $this->getUserEmails($token));
    }

    protected function getUserEmails($token) {
        $response = $this->getHttpClient()->get('https://api.github.com/user/emails?access_token=' . $token, [
            'headers' => [
                'Accept' => 'application/vnd.github.v3+json'
            ]
        ]);

        return ['emails' => json_decode($response->getBody(), true)];
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user) {
        return (new User)->setRaw($user)->map([
            'id' => $user['id'], 'nickname' => $user['login'], 'name' => $user['name'],
            'email' => $user['email'] === null ? $this->getPrimaryEmail($user['emails']) : $user['email'],
            'avatar' => $user['avatar_url'], 'emails' => $user['emails']
        ]);
    }

    protected function getPrimaryEmail(array $emails) {
        foreach ($emails as $email) {
            if ($email['primary']) return $email['email'];
        }
        return null;
    }

}
