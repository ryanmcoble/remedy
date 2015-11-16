<?php

use Coble\General\Commanding\Products\RetrieveProductsCommand;


class ProductController extends BaseController
{
	
	/**
	 * Get a single product
	 * Retrieve a product from the cache, or from shopify and then stored in the cache
	 */
	public function getOne($id)
	{

		if(!$id) return Response::json(['status' => 'error', 'message' => 'No ID was given.']);

		if(Input::has('fields'))
		{
			// remove all fields that are not given
		}

		return '';

	}


	/**
	 * Get a multiple products
	 * Scenarios
	 *  - Get all products from the cache or get as many as shopify will allow
	 *  - Get products based on certain filter criteria
	 *  - Get products and only send back certain fields
	 */
	public function getMany()
	{
	    // if(Input::has('filters')) {
		// 	// get filtered results
		// }
		// else
		// {
		// 	// get un-filtered results
		// }

		// if(Input::has('sorted_by')) {
		// 	// sort results
		// }

		$filters = Input::has('filters') ? Input::get('filters') : '';

		$limit = Input::has('limit') ? (int) Input::get('limit') : 100;
		if($limit > 1000) $limit = 1000; // limit to 1000

		$sorted_by = Input::has('sorted_by') ? (int) Input::get('sorted_by') : '';


		return $this->commandBus->execute(new RetrieveProductsCommand(
			$filters,
			$limit,
			$sorted_by
		));

	}

}





