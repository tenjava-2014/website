<?php namespace TenJava\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Socialite;

class DriverServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        $this->registerCustomDriver();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
    }

    private function registerCustomDriver() {
        Socialite::extend('github_email', function (Application $app) {
            $config = $app['config']['services.github'];
            return $this->buildProvider('TenJava\Socialite\GithubEmailProvider', $config);
        });
    }

    /**
     * Build an OAuth 2 provider instance.
     *
     * @param  string $provider
     * @param  array $config
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function buildProvider($provider, $config) {
        return new $provider(
            $this->app['request'], $config['client_id'],
            $config['client_secret'], $config['redirect']
        );
    }

}
