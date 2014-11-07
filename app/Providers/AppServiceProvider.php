<?php namespace TenJava\Providers;

use Illuminate\Routing\Router;

class AppServiceProvider extends ServiceProvider {

    /**
     * All of the application's route middleware keys.
     *
     * @var array
     */
    protected $middleware = [
        'auth' => 'TenJava\Http\Middleware\AuthMiddleware',
        'auth.basic' => 'TenJava\Http\Middleware\BasicAuthMiddleware',
        'csrf' => 'TenJava\Http\Middleware\CsrfMiddleware',
        'guest' => 'TenJava\Http\Middleware\GuestMiddleware',
    ];

    /**
     * The application's middleware stack.
     *
     * @var array
     */
    protected $stack = [
        'TenJava\Http\Middleware\MaintenanceMiddleware',
        'Illuminate\Cookie\Middleware\Guard',
        'Illuminate\Cookie\Middleware\Queue',
        'Illuminate\Session\Middleware\Reader',
        'Illuminate\Session\Middleware\Writer',
    ];

    /**
     * Build the application stack based on the provider properties.
     *
     * @return void
     */
    public function stack() {
        $this->app->stack(function (Stack $stack, Router $router) {
            return $stack
                ->middleware($this->stack)->then(function ($request) use ($router) {
                    return $router->dispatch($request);
                });
        });
    }

}
