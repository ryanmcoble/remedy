<?php
namespace Coble\General\Commanding;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class CommandingServiceProvider extends ServiceProvider
{
	
	public function register()
	{
		/**
		 * Commanding bindings
		 */
		

		// Command Bus
		// $this->app->singleton('Coble\General\Repositories\ProductRepository', function() {
		// 	return new CachingProductRepository(
		// 		new EloquentProductRepository,
		// 		$this->app['cache.store']
		// 	);
		// });

		$this->app->bind('Coble\General\Commanding\CommandBus', 'Coble\General\Commanding\DefaultCommandBus');

	}
}