<?php


use Coble\General\API\ResponseBuilder;


/**
 * Landing page, after installation / authentication
 */
Route::get('/', function()
{

	$shop = Shop::where('domain', Session::get('shop'))->first();

	$apiKey = ApiKey::where('shop_id', $shop->id)->with('accessLevel', 'shop')->first();

	return View::make('hello')->with('apiKey', $apiKey);
})->before('shopify.auth');


Route::get('/install', function()
{
	return View::make('install');
});
Route::post('/install', function()
{
	$domain = Input::get('domain');

	$shopifyController = new ShopifyAuthController;
	$installUrl = $shopifyController->installURL($domain);

	return View::make('install')->with('install_url', $installUrl);
});


/**
 * Shopify-related routes
 */

//get the install url for the app
Route::get('/authURL/{url}', array(
	'uses' => 'ShopifyAuthController@installURL'
));

//authorize the shopify shop / install the app to the shopify shop
Route::get('/auth', array(
	'uses' => 'ShopifyAuthController@installOrAuthenticate'
));

//uninstall webhook callback
Route::post('/uninstall', array(
	'uses' => 'ShopifyAuthController@uninstall'
));


/**
 * Public API v1 routes
 */
Route::group(['prefix' => 'api/v1', 'before' => 'api.auth|api.rate'], function() {

	/**
	 * Get a single product
	 */
	Route::get('products/{id}', array(
		'uses' => 'ProductController@getOne'
	));

	/**
	 * Get all / filtered / sorted products
	 */
	Route::get('products', array(
		'uses' => 'ProductController@getMany'
	));

});



/**
 * Public API v2 routes
 */
Route::group(['prefix' => 'api/v{version_number}', 'before' => 'api.auth|api.rate'], function() {

	/**
	 * Future API version
	 */
	Route::get('{any?}', function() {

		$public_key = Request::header('X-Remedy-Auth');
		$apiKey = ApiKey::where('public_key', $public_key)->first();

		$builder = new ResponseBuilder($apiKey);
		$builder->setStatus(418, 'cool', 'I like where your head is at but mine is not there yet. ;)');
		return $builder->getResponse();
	});
	

});


