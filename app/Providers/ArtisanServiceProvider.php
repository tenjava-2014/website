<?php namespace TenJava\Providers;

use Illuminate\Support\ServiceProvider;

class ArtisanServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['TenJava\Console\InspireCommand'];
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->commands('TenJava\Console\InspireCommand');
    }

}
