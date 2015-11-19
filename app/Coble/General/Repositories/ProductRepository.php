<?php
namespace Coble\General\Repositories;

interface ProductRepository
{
	public function getAll($limit);

	public function getFiltered($filteres, $limit, $sorted_by = 'id', $with = '');

	public function find($id);
}