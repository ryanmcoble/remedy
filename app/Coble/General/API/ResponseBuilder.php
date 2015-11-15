<?php
namespace Coble\General\API;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Pagination\Paginator;

use ApiKey;
use ApiLog;

class ResponseBuilder
{
	private $headers = [];

	private $apiKey;

	private $data = [];

	private $statusCode = 200;

	private $status = '';

	private $message = '';

	private $pagination = [];



	public function setApiKey(ApiKey $apiKey)
	{
		$this->apiKey = $apiKey;
	}

	public function setStatus($code = 200, $status = 'success', $message = '')
	{
		$this->statusCode = $code;
		$this->status     = $status;
		$this->message    = $message;
	}

	public function setData($data = [])
	{
		$this->data = $data;
	}


	private function buildHeader()
	{
		// only if an api key is given
		if($this->apiKey) {
			$rateLimit = RateLimiter::get($this->apiKey->public_key);

			$this->headers['X-Remedy-Rate-Limit'] = $rateLimit->remaining . '/' . $rateLimit->total;
		}
	}


	/**
	 * Create a paginated response
	 * @param Paginator $products - array of products
	 * @param array $data - array of 
	 */
	protected function buildPagination(Paginator $object)
	{
		if($object->getTotal() > $object->getPerPage()) {
			$this->pagination = [
				'total' => $object->getTotal(),
				'total_pages' => ceil($object->getTotal() / $object->getPerPage()),
				'current_page' => $object->getCurrentPage(),
				'per_page' => $object->getPerPage(),
			];
		}

	}


	public function getResponse()
	{
		$this->buildHeader();

		$responseData = [];
		$responseData['status'] = [
			'http_code'  => $this->statusCode,
			'type'       => $this->status,
			'message'    => $this->message
		];

		// only if an api key is given
		if($this->apiKey) {
			$responseData['status']['rate_limit'] = RateLimiter::get($this->apiKey->public_key);
		}


		$dataObject = [];

		if($this->data) {
			$this->buildPagination($this->data);

			$dataObject = [
				'data' => $this->data
			];
		}

		// only if pagination is needed
		if($this->pagination)
		{
			$responseData['status']['pagination'] = $this->pagination;
		}

		// auto-check for error status codes
		if($this->statusCode > 400)
		{
			$log = new ApiLog;
			$log->api_key_id = $this->apiKey->id;
			$log->status = $this->status;
			$log->message = $this->message;
			$log->ip_address = Request::ip();
			$log->save();
		}
	

		$responseData = array_merge($responseData, $dataObject);

		return Response::json($responseData, $this->statusCode, $this->headers);
	}

}