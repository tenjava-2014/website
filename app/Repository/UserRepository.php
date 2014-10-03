<?php namespace TenJava\Repository;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use TenJava\User;

class UserRepository {

    public function getGitHubUser(SocialiteUser $socialiteUser) {
        return $this->byGitHubID($socialiteUser);
    }

    private function byGitHubID(SocialiteUser $socialiteUser) {
        return $this->firstOrCreate(User::query()->where('gh_id', $socialiteUser->getId()), $socialiteUser);
    }

    public function firstOrCreate(Builder $builder, SocialiteUser $socialiteUser) {
        $user = $builder->first();
        return ($user !== null) ? $this->update($user, $socialiteUser) : $this->create($socialiteUser);
    }

    public function update(User $user, SocialiteUser $socialiteUser) {
        $user->username = $socialiteUser->getNickname();
        $user->name = $socialiteUser->getName();
        $user->email = $socialiteUser->getEmail();
        $user->emails = json_encode($this->getGitHubEmails($socialiteUser));
        $user->save();
        return $user;
    }

    private function getGitHubEmails(SocialiteUser $socialiteUser) {
        $emails = $socialiteUser->user['emails'];
        $real_emails = [];
        foreach ($emails as $email) {
            array_push($real_emails, $email['email']);
        }
        return $real_emails;
    }

    public function create(SocialiteUser $socialiteUser) {
        $user = new User();
        $user->gh_id = $socialiteUser->getId();
        $this->update($user, $socialiteUser);
        return $user;
    }
}
