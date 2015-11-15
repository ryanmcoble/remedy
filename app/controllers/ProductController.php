<?php

use Coble\General\API\ResponseBuilder;
use Coble\General\Repositories\ProductRepository;


class ProductController extends BaseController
{
	protected $productRepo;
	protected $response;

	public function __construct(ResponseBuilder $response, ProductRepository $productRepo)
	{
		parent::__construct();

		$this->response    = $response;
		$this->productRepo = $productRepo;
	}
	
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

		// if(Input::has('sorted')) {
		// 	// sort results
		// }


		$limit = Input::has('limit') ? (int) Input::get('limit') : 100;
		if($limit > 1000) $limit = 1000;


		$products = $this->productRepo->getAll($limit)->toArray();


		$this->response->setApiKey($this->apiKey);
		if(!count($products))
		{
			$this->response->setStatus(404, 'not_found', 'No products were found.');
		}
		else
		{
			$this->response->setStatus(200, 'success', count($products) . ' products were found.');
			$this->response->setData($products);
		}

		return $this->response->getResponse();
	}

}





