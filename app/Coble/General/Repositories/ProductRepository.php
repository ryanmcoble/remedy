<?php
namespace Coble\General\Repositories;

interface ProductRepository
{
	public function getAll();

	public function find($id);
}