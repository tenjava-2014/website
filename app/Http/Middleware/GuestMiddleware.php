<?php namespace TenJava\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Authenticator;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Http\RedirectResponse;

class GuestMiddleware implements Middleware {

    /**
     * The authenticator implementation.
     *
     * @var Authenticator
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Authenticator $auth
     * @return \TenJava\Http\Middleware\GuestMiddleware
     */
    public function __construct(Authenticator $auth) {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($this->auth->check()) {
            return new RedirectResponse(url('/'));
        }
        return $next($request);
    }

}
