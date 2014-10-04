<?php namespace TenJava\Repository;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use TenJava\User;

interface UserRepositoryInterface {

    public function create(SocialiteUser $socialiteUser);

    public function firstOrCreate(Builder $builder, SocialiteUser $socialiteUser);

    public function getGitHubUser(SocialiteUser $socialiteUser);

    public function getStaffMembers();

    public function update(User $user, SocialiteUser $socialiteUser);

}
