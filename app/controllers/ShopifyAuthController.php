<?php

class ShopifyAuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Shopify Authentication Controller
	|--------------------------------------------------------------------------
	|
	*/


	/**
	 * Main Controller Method for Shopify Authorization
	 */
	public function installOrAuthenticate()
	{
		if (Input::get('code')) {
			// New install

			Log::info('New Install: ' . Input::get('shop'));
			$sh = App::make('ShopifyAPI', ['API_KEY'     => Config::get('shopify.APP_API_KEY'),
			                               'API_SECRET'  => Config::get('shopify.APP_API_SECRET'),
			                               'SHOP_DOMAIN' => Input::get('shop')
			]);

			// Get Access Token

			try {
				$accessToken = $sh->getAccessToken(Input::get('code'));
			}
			catch (Exception $e) {
				Log::error($e->getMessage());
				die('<pre>Error: ' . $e->getMessage() . '</pre>');
			}

			$shop = Shop::where('domain', Input::get('shop'))->first();

			if (!$shop) {
      			Log::info(__LINE__ . ': New Shop');
				$shop = new Shop;
			}

			$shop->setDomain(Input::get('shop'));
			$shop->setAccessToken($accessToken);
			$shop->save();
			$this->updateShopInfo($shop);

			/**
			 * Create webhook for uninstall
			 */
			$hookData = array('webhook' => array('topic' => 'app/uninstalled', 'address' => 'https://' . Request::server('HTTP_HOST') . '/uninstall-hook', 'format' => 'json'));
			try {
				$sh->setup(['ACCESS_TOKEN' => $shop->getAccessToken()]);
				$sh->call(['URL' => 'webhooks.json', 'METHOD' => 'POST', 'DATA' => $hookData]);
			}
			catch (Exception $e) {
				Log::error('Issue creating uninstall webhook - ' . $shop->domain . ' : ' . $e->getMessage());
			}

			Session::put('shop', $shop->domain);
			return Redirect::to('/');
		}
		else {
			// Accessing app from apps screen
			$shop = Shop::where('domain', Input::get('shop'))->first();
			if ($shop) {
				Log::info('Shop found after Auth: ' . Input::get('shop'));
				$this->updateShopInfo($shop);
				Session::put('shop', Input::get('shop'));

				return Redirect::to('/');
			}
			else {
				Log::warning('Shop redirecting to install: ' . Input::get('shop'));
        		$sh = App::make('ShopifyAPI', ['API_KEY' => Config::get('shopify.APP_API_KEY'), 'SHOP_DOMAIN' => Input::get('shop')]);
          		return Redirect::to($sh->installURL(['permissions' => Config::get('shopify.APP_API_SCOPE'), 'redirect' => 'https://' . $_SERVER['HTTP_HOST'] . '/auth']));
			}
		}
	} // end check()


	/**
	 * Soft deletes shop from DB
	 * @return string
	 * @TODO Verify data
	 */
	public function uninstall() {
		$shop = Shop::where('domain', Input::get('myshopify_domain'))->firstOrFail();
    	$shop->delete();
		return 'Thank You!';
	}

	public function installURL($shopURL = '') {
		$sh = App::make('ShopifyAPI', ['API_KEY' => Config::get('shopify.APP_API_KEY'), 'SHOP_DOMAIN' => $shopURL]);
		return $sh->installURL(['permissions' => json_decode(Config::get('shopify.APP_API_SCOPE')), 'redirect' => 'https://' . $_SERVER['HTTP_HOST'] . '/auth']);
	}



	public function getShop() {
		$shop = Shop::where('domain', '=', Session::get('shop'))->first();
		$sh = App::make('ShopifyAPI', ['API_KEY' => Config::get('shopify.APP_API_KEY'), 'API_SECRET' => Config::get('shopify.APP_API_SECRET')]);
		$sh->setup(['SHOP_DOMAIN' => $shop->domain, 'ACCESS_TOKEN' => $shop->getAccessToken()]);
		$res = '';

		return Response::json(['status' => 'success', 'themes' => $res, 'shop' => $shop]);
	}




	/**
	 * Updates several parameters on app install and on auth check
	 * @param null $shop
	 * @return bool
	 */
	private function updateShopInfo($shop = NULL) {
		try {
			$sh = App::make('ShopifyAPI', ['API_KEY' => Config::get('shopify.APP_API_KEY'), 'API_SECRET' => Config::get('shopify.APP_API_SECRET'), 'SHOP_DOMAIN' => $shop->domain, 'ACCESS_TOKEN' => $shop->getAccessToken() ]);
			$data = $sh->call(['URL' => 'shop.json']);

			if ($data) {
				Session::put('shopInfo', $data->shop);
				$shop->setDomain($data->shop->myshopify_domain);
				$shop->save();
			}
			return TRUE;
		}
		catch (Exception $e) {
			Log::error('[AuthController::updateShopInfo() - ' . $shop->domain . '] ' . $e->getMessage());
			return FALSE;
		}
	}
}
