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


	public function getCacheKey(array $data)
	{
		return md5(implode('+', $data));
	}


	public function getAll($limit)
	{

		//dd($this->repository->getAll($limit)->getCollection()->toArray());

		$data = [
			$limit,
		];

		return $this->cache->remember('products.all.' . $this->getCacheKey($data), 5, function() use ($limit) {

			$products = $this->repository->getAll($limit);

			return $products;
		});
	}

	public function getFiltered($filtersString, $limit = 20, $sorted_by = 'id', $withString = '')
	{

		//dd($this->repository->getAll($limit)->getCollection()->toArray());

		$data = [
			$filtersString,
			$limit,
			$sorted_by,
			$withString,
		];


		return $this->cache->remember('products.filtered.' . $this->getCacheKey($data), 5, function() use ($filtersString, $limit, $sorted_by, $withString) {

			$products = $this->repository->getFiltered($filtersString, $limit, $sorted_by, $withString);

			return $products;
		});
	}


	public function find($id)
	{
		return $this->cache->remember('products.one', 5, function() use ($id) {
			return $this->repository->find($id);
		});
	}
	
}