<?php namespace TenJava\Providers;

use Illuminate\Foundation\Support\Providers\FilterServiceProvider as ServiceProvider;

class FilterServiceProvider extends ServiceProvider {

	/**
	 * The filters that should run before all requests.
	 *
	 * @var array
	 */
	protected $before = [
		'TenJava\Http\Filters\MaintenanceFilter',
	];

	/**
	 * The filters that should run after all requests.
	 *
	 * @var array
	 */
	protected $after = [
		//
	];

	/**
	 * All available route filters.
	 *
	 * @var array
	 */
	protected $filters = [
		'auth' => 'TenJava\Http\Filters\AuthFilter',
		'auth.basic' => 'TenJava\Http\Filters\BasicAuthFilter',
		'csrf' => 'TenJava\Http\Filters\CsrfFilter',
		'guest' => 'TenJava\Http\Filters\GuestFilter',
	];

}
