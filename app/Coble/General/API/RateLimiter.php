<?php
namespace Coble\General\API;

use Illuminate\Support\Facades\Cache;

use Carbon\Carbon;


class RateLimiter
{

	/**
	 * Check if the api key is passed its limit, while also adding or updating cache
	 * 
	 * @param ApiKey $apiKey - The api key in question
	 * @return boolean - Is the api key being rate limited
	 */
	public static function check(\ApiKey $apiKey)
	{

		$public_key = $apiKey->public_key;
		$accessLevel = $apiKey->accessLevel;

		// check cache for the key, create is doesn't exist
		if(!Cache::has($public_key))
		{
			self::generateCache($public_key, $accessLevel);
		}
		
		// get the cache
		$cache = json_decode(Cache::get($public_key));

		// create timestamp instances for when the cache was created and now
		$cachedTimestamp = Carbon::createFromFormat('Y-m-d H:i:s', $cache->expires_at);
		$timestamp = Carbon::now();

		// check if cache has expired, if so create cache
		if($timestamp->gt($cachedTimestamp)) {
			
			Cache::forget($public_key);

			self::generateCache($public_key, $accessLevel);

			$cache = json_decode(Cache::get($public_key));
		}

		// check if api key is over request limit
		if($cache->remaining <= 0) return false;

		// decrement remaining requests by 1
		$cache->remaining -= 1;

		// update cache
		Cache::put($apiKey->public_key, json_encode($cache), 0);

		return true;
	}


	public static function generateCache($public_key, \AccessLevel $accessLevel)
	{
		$expiresAt = self::generateExpiration($accessLevel->interval_type, $accessLevel->interval_value);

		// if no cache, create one with total and remain as the same
		$cache = [
			'total'      => $accessLevel->request_limit,
			'remaining'  => $accessLevel->request_limit,
			'expires_at' => $expiresAt->toDateTimeString(),
		];

		Cache::put($public_key, json_encode($cache), 0);
	}


	/**
	 * Generate a Carbon instance based on the access level's type and value
	 * @param string $type - The type of access level restriction (second, minute, day, etc)
	 * @param integer $value - The value of the access level restriction (number of day, etc)
	 * @return Carbon - Instance of the Carbon library
	 */
	public static function generateExpiration($type, $value)
	{
		$expiresAt = 0;

		switch($type)
		{
			case 'second':
				$expiresAt = Carbon::now()->addSeconds($value);
			break;
			case 'minute':
				$expiresAt = Carbon::now()->addMinutes($value);
			break;
			case 'hour':
				$expiresAt = Carbon::now()->addHours($value);
			break;
			case 'day':
				$expiresAt = Carbon::now()->addDays($value);
			break;
		}

		return $expiresAt;

	}

	/**
	 * Get the current current cache for the Api key
	 *
	 * @param ApiKey $apiKey - The api key in question
	 * @return StdClass Object containing rate limiting details
	 */
	public static function get($public_key)
	{

		if(!Cache::has($public_key)) return false;

		return json_decode(Cache::get($public_key));
	}


}