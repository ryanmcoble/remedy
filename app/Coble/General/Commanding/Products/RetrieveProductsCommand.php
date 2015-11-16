<?php
namespace Coble\General\Commanding\Products;


class RetrieveProductsCommand
{

	public $filters;

	public $limit;

	public $sorted_by;

	
	public function __construct($filters, $limit, $sorted_by)
	{
		$this->filters   = $filters;

		$this->limit     = $limit;

		$this->sorted_by = $sorted_by;
	}

}