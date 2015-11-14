<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
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
Route::group(['prefix' => 'api/v1', 'before' => 'api.auth'], function() {

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
Route::group(['prefix' => 'api/v{version_number}'], function() {

	/**
	 * Future API version
	 */
	Route::get('{any?}', function() {
		return Response::json(['status' => 'cool', 'message' => 'I like where your head is at but mine is not there yet. ;)'], 418);
	});
	

});


