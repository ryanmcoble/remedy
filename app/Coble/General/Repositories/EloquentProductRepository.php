<?php
namespace Coble\General\Repositories;

use Coble\General\Filtering\FilterTranslator;

use Illuminate\Support\Facades\Log;

use Product;


class EloquentProductRepository implements ProductRepository
{

	// FUTURE TODO: Create traits for different searchable methods

	/**
	 * Get all
	 * @return Collection of Product models
	 */
	public function getAll($limit)
	{
		//dd(Product::paginate($limit));
		return Product::paginate($limit);
	}


	/**
	 * Get products based on a filter
	 * @return Collection of Product models
	 */
	public function getFiltered($filtersString, $limit = 20, $sorted_by = 'id', $withString = '')
	{

		$products = []; // found products


		$productQuery = Product::orderBy($sorted_by);

		// convert the string form of filters to arrays that can be parsed
		$filters = FilterTranslator::toObject($filtersString);
		$filterCount = count($filters);
		
		// account for nested fields

		// convert filter functions into actual algorithms

		if($filterCount) 
		{
			for($i = 0; $i < count($filters); $i++)
			{
				$productQuery->where($filters[$i]->subject_field, $filters[$i]->filter_function, $filters[$i]->query);
			}
		}


		$eageloads = explode(',', $withString);

		for($i = 0; $i < count($eageloads); $i++)
		{
			$productQuery->with($eageloads[$i]);
		}


		$products = $productQuery->take($limit)->get();

		return $products;
	}


	/**
	 * Find by db id
	 * @param integer $id Id of the database row
	 * @return Product model
	 */
	public function find($id)
	{
		return Product::find($id)->first();
	}

}