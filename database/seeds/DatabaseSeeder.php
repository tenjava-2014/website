<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use TenJava\Claim;
use TenJava\Staff;
use TenJava\Team;
use TenJava\User;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();

        $this->call('ApplicationSeeder');

        $this->command->info("Seeded database.");
    }

}

class ApplicationSeeder extends Seeder {

    public function run() {
        DB::table('users')->delete();
        DB::table('staff')->delete();
        DB::table('teams')->delete();

        User::create([
            'gh_id' => 955250,
            'username' => 'jkcclemens',
            'name' => 'Kyle Clemens',
            'email' => 'jkcclemens@foo.bar',
            'emails' => json_encode([
                'jkcclemens@foo.bar',
                'another@one.com'
            ]),
            'allow_email' => true
        ]);
        User::create([
            'gh_id' => 2552726,
            'username' => 'lol768',
            'name' => 'Lol Seven-Hundred-Sixty-Eight',
            'email' => 'lol768@foo.bar',
            'allow_email' => true,
        ]);
        User::create([
            'gh_id' => 1509618,
            'username' => 'hawkfalcon',
            'name' => 'Hawk Falcon',
            'email' => 'hawkfalcon@foo.bar',
            'allow_email' => false
        ]);
        Staff::create([
            'user_id' => 1,
            'status' => 7
        ]);
        Team::create([
            'name' => 'Prancing Jackrabbits',
            'leader_id' => 2,
            'description' => 'Wow!',
            'general_rules' => 'Stay in school.',
            'prize_rules' => 'Even split.',
            'miscellaneous_rules' => "Don't die."
        ]);
        /**
         * @var $user User
         */
        $user = User::find(2);
        $user->team_id = 1;
        $user->save();
        $user = User::find(3);
        $user->team_id = 1;
        $user->save();
        Claim::create([
            'staff_id' => 1,
            'team_id' => 1
        ]);
    }

}
