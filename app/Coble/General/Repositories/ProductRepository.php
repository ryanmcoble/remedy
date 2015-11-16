<?php
namespace Coble\General\Repositories;

interface ProductRepository
{
	public function getAll($limit);

	public function find($id);
}