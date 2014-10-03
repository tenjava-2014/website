<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();

        $this->call('ApplicationSeeder');

        $this->command->info("Seeded database.");
    }

}

class ApplicationSeeder extends Seeder {

    public function run() {
        DB::table('applications')->delete();

        Application::create(array(
            'gh_username' => 'lol768',
            'dbo_username' => 'lol768',
            'github_email' => json_encode(array('foo@bar.com')),
            'judge' => false
        ));

        Application::create(array(
            'gh_username' => 'Chester',
            'dbo_username' => 'ChesterTheBrave',
            'github_email' => json_encode(array('chester@bar.com')),
            'judge' => false
        ));

        Application::create(array(
            'gh_username' => 'judge1',
            'dbo_username' => 'judge1',
            'github_email' => json_encode(array('judge@bar.com')),
            'gmail' => 'judge@bar.com',
            'irc_username' => 'judge1',
            'mc_username' => 'judge1',
            'judge' => true
        ));
    }

}