<?php
namespace Coble\General\Filtering;

use StdClass;

class FilterTranslator
{
	
	/**
	 * Convert a filter string to an array
	 */
	public static function toArray($filters)
	{	

		$filters = explode('|', $filters); // separate filters into array

		$filtersArray = [];

		if(count($filters))
		{
			foreach($filters as $filter)
			{
				$filterParts = explode('+', $filter);

				if(count($filterParts) == 3)
				{
					$filtersArray[] = [
						'subject_field'  => $filterParts[0],
						'filter_function' => $filterParts[1],
						'query'  => $filterParts[2],
					];
				}
			}
		}

		return $filtersArray;
	}

	/**
	 * Convert a filter string to an object
	 */
	public static function toObject($filters)
	{
		$filters = explode('|', $filters); // separate filters into array

		$filtersArray = [];

		if(count($filters))
		{
			foreach($filters as $filter)
			{
				$filterParts = explode('+', $filter);

				if(count($filterParts) == 3)
				{
					$filterObj = new StdClass;
					$filterObj->subject_field = $filterParts[0];
					$filterObj->filter_function = $filterParts[1];
					$filterObj->query = $filterParts[2];

					$filtersArray[] = $filterObj;
				}
			}
		}

		return $filtersArray;
	}

	/**
	 * Convert a filter array or object to a string
	 */
	public static function toString()
	{

	}


}