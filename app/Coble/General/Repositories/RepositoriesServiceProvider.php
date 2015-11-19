<?php
namespace Coble\General\Repositories;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class RepositoriesServiceProvider extends ServiceProvider
{
	
	public function register()
	{
		/**
		 * Repository bindings
		 */
		

		// Product
		$this->app->singleton('Coble\General\Repositories\ProductRepository', function() {
			
			// DISABLE CACHE for now
			return new CachingProductRepository(
				new EloquentProductRepository,
				$this->app['cache.store']
			);

			//return new EloquentProductRepository();
		});

	}
}