<?php

class Shop extends Eloquent {

	protected $fillable = ['domain', 'access_token'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 's_shops';

	/**
	 * Formats the shop domain to fit what every database call will be looking for
	 * @param 	$domain
	 * @return	string		db-formatted domain
	 * @author Josh
	 */
	public function formatDomain($domain = '')
	{
		$noProtocol = preg_replace('/(http(s)?:\/\/)?/', '', $domain);
		if (strpos($noProtocol, '/') !== FALSE)
		{
			return substr($noProtocol, 0, strpos($noProtocol, '/'));
		}
		else
		{
			return $noProtocol;
		}
	}
	public function getAccessToken()
	{
		return $this->decrypt($this->access_token, \Config::get('shopify.API_ACTK_KEY'));
	}
	public function setAccessToken($token = '')
	{
		$this->access_token = $this->encrypt($token, \Config::get('shopify.API_ACTK_KEY'));
	}
	public function setDomain($domain = '')
	{
		$this->domain = $this->formatDomain($domain);
	}
	private function encrypt($text = '', $key = '')
	{
		return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
	}
	private function decrypt($text = '', $key = '')
	{
		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
	}

}
