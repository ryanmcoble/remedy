<?php

class BaseController extends Controller {

	protected $apiKey;


	public function __construct()
	{
		// store the current request's api key
		$public_key = Request::header('X-Remedy-Auth');

		$this->apiKey = ApiKey::where('public_key', $public_key)->first();
	}

}
