<?php namespace TenJava\Providers;

use Illuminate\Foundation\Support\Providers\FilterServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends \Illuminate\Foundation\Support\Providers\RouteServiceProvider {

	/**
	 * The filters that should run before all requests.
	 * TODO: FIX
	 * @var array
	 */
	//protected $before = [
	//	'TenJava\Http\Filters\MaintenanceFilter',
	//];

	/**
	 * All available route filters.
	 *
	 * @var array
	 */
	protected $middleware = [
		'auth' => 'TenJava\Http\Filters\AuthFilter',
		'auth.basic' => 'TenJava\Http\Filters\BasicAuthFilter',
		'csrf' => 'TenJava\Http\Filters\CsrfFilter',
		'guest' => 'TenJava\Http\Filters\GuestFilter',
	];

	/**
	* Called before routes are registered.
	*
	* Register any model bindings or pattern based filters.
	*
	* @param Router $router
	* @return void
	*/
	public function before(Router $router) {}

	/**
	* Define the routes for the application.
	*
	* @param Router $router
	* @return void
	*/
	public function map(Router $router) {
		$router->group([], function ($router) {
			(new Registration($router))->registerRoutes();
		});
	}
}
