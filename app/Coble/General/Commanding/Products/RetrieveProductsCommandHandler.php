<?php
namespace Coble\General\Commanding\Products;

use Illuminate\Support\Facades\Request;

use Coble\General\Commanding\CommandHandler;

use Coble\General\API\ResponseBuilder;

use Coble\General\Repositories\ProductRepository;

use ApiKey;


class RetrieveProductsCommandHandler implements CommandHandler
{

	protected $productRepo;

	protected $responseBuilder;

	protected $apiKey;


	public function __construct(ProductRepository $productRepo, ResponseBuilder $responseBuilder)
	{
		$this->productRepo      = $productRepo;

		$this->responseBuilder  = $responseBuilder;

		// store the current request's api key
		$public_key             = Request::header('X-Remedy-Auth');

		$this->apiKey           = ApiKey::where('public_key', $public_key)->first();
	}
	

	public function handle($command)
	{
		$products = $this->productRepo->getAll($command->limit)->toArray();

		$this->responseBuilder->setApiKey($this->apiKey);
		if(!count($products))
		{
			$this->responseBuilder->setStatus(404, 'not_found', 'No products were found.');
		}
		else
		{
			$this->responseBuilder->setStatus(200, 'success', count($products) . ' products were found.');
			$this->responseBuilder->setData($products);
		}

		return $this->responseBuilder->getResponse();
	}

}