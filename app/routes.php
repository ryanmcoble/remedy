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


/**
 * Shopify connector
 */

//installation
Route::get('/install', function()
{
	return View::make('install')->with('install_url', '');
});
Route::post('/install', function()
{
	$domain = Input::get('domain');

	$shopifyController = new ShopifyAuthController;
	$installUrl = $shopifyController->installURL($domain);

	return View::make('install')->with('install_url', $installUrl);
});

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
 * User account routes
 */

// upgrate the account to a different tier
Route::get('/user/upgrade', array(
	'uses' => 'AccountController@getUpgrade',
	'as' => 'upgrade-account'
));

// post upgrate the account to a different tier
Route::post('/user/upgrade', array(
	'uses' => 'AccountController@postUpgrade',
	'as' => 'post-upgrade-account'
));

// change account settings
Route::get('/user/settings', array(
	'uses' => 'AccountController@getSettings',
	'as' => 'update-account-settings'
));

// post account settings
Route::post('/user/settings', array(
	'uses' => 'AccountController@postSettings',
	'as' => 'post-update-account-settings'
));

// list account api keys
Route::get('/user/apikeys', array(
	'uses' => 'AccountController@postSettings',
	'as' => 'list-account-apikeys'
));

// create new account api key
Route::post('/user/apikeys', array(
	'uses' => 'AccountController@createApiKey',
	'as' => 'create-account-apikey'
));

// delete account api key by id
Route::delete('/user/apikeys/{apikey_id}', array(
	'uses' => 'AccountController@deleteApiKey',
	'as' => 'delete-account-apikey'
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


