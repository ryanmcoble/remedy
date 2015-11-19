<?php
namespace Coble\General\Commanding\Products;

use Coble\General\Commanding\CommandHandler;

use Coble\General\API\ResponseBuilder;

use Coble\General\Repositories\ProductRepository;



class RetrieveProductsCommandHandler implements CommandHandler
{

	protected $productRepo;

	protected $responseBuilder;


	public function __construct(ProductRepository $productRepo, ResponseBuilder $responseBuilder)
	{
		$this->productRepo      = $productRepo;

		$this->responseBuilder  = $responseBuilder;
	}
	

	public function handle($command)
	{
		//$products = $this->productRepo->getAll($command->limit);

		$products = $this->productRepo->getFiltered($command->filters, $command->limit, $command->sorted_by, $command->with);


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