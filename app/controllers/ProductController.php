<?php

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
	    if(Input::has('filtered')) {
			// get filtered results
		}
		else
		{
			// get un-filtered results
		}

		if(Input::has('sorted')) {
			// sort results
		}

		return '';
	}

}