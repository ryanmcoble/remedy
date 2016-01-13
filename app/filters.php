<?php

use Coble\General\API\RateLimiter;
use Coble\General\API\ResponseBuilder;

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});



/*
|--------------------------------------------------------------------------
| Shopify Authentication Filter
|--------------------------------------------------------------------------
|
| The shopify authentication filter provides an easy way to make sure the app has been
| authenticated before actually being able to change anything in our database
| USED: on all routes other than auth, uninstall and install url
|
*/

Route::filter('shopify.auth', function()
{
	if(!Session::has('shop'))
	{
		App::abort(403, 'Unauthorized through Shopify, please re-install the communicator app or check your API key.');
	}
});


/*
|--------------------------------------------------------------------------
| Public API
|--------------------------------------------------------------------------
|
| Public API filter provides header based API key authentication and API rate limiting
|
*/

Route::filter('api.auth', function()
{

	// do we have an auth header
	$authToken = Request::header('X-Remedy-Auth');
	if(!$authToken)
	{
		$builder = new ResponseBuilder();
		$builder->setStatus(401, 'missing_api_key', 'No api key given.');
		return $builder->getResponse();
	}

	// does that auth header contain a valid api key
	$apiKey = ApiKey::where('public_key', $authToken)->first();
	if(!$apiKey)
	{
		$builder = new ResponseBuilder();
		$builder->setStatus(401, 'invalid_api_key', 'Unauthorized request. This event has been logged. Do it 2 more times, I DARE you!');
		return $builder->getResponse();
	}

});


Route::filter('api.rate', function()
{
	$authToken = Request::header('X-Remedy-Auth');
	$apiKey = ApiKey::where('public_key', $authToken)->first();

	// check if the api key is over their limit and store / update the cache
	if(!RateLimiter::check($apiKey))
	{
		$builder = new ResponseBuilder();
		$builder->setStatus(429, 'rate_limited', 'Too many requests. You have been rate limited, because the internet. ;)');
		return $builder->getResponse();
	}
});



