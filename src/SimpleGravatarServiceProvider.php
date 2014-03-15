<?php

namespace Euantor\SimpleGravatar;

use Illuminate\Support\ServiceProvider;

class SimpleGravatarServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('euantor/simple-gravatar');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('simplegravatar', '\Euantor\SimpleGravatar\Gravatar');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('simplegravatar');
	}
}
