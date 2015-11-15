<?php
namespace Coble\General\Repositories;

use Product;


class EloquentProductRepository implements ProductRepository
{

	// FUTURE TODO: Create traits for different searchable methods

	/**
	 * Get all
	 * @return Collection of Product models
	 */
	public function getAll()
	{
		//return Product::paginate($limit);
		return Product::all();
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