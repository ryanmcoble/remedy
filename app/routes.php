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
 * Public API routes
 */

