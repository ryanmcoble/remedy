<?php
namespace Coble\General\Repositories;

use Illuminate\Cache\Repository as Cache;

class CachingProductRepository implements ProductRepository
{
	private $repository;
	private $cache;

	public function __construct(ProductRepository $repository, Cache $cache)
	{
		$this->repository = $repository;
		$this->cache      = $cache;
	}


	public function getAll($limit)
	{

		//dd($this->repository->getAll($limit)->getCollection()->toArray());

		return $this->cache->remember('products.all', 30, function() use ($limit) {

			$products = $this->repository->getAll($limit)->getCollection()->toArray();

			return $products;
		});
	}


	public function find($id)
	{
		return $this->cache->remember('products.one', 30, function() use ($id) {
			return $this->repository->find($id);
		});
	}
	
}