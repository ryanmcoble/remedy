<?php

class ProductSeeder extends Seeder
{

	public function run()
	{

		$shop = Shop::all()->first();

		if(!$shop) return ;

		$shopId = $shop->id;


		$seedData = [
			[
				'shopify_id'      => '32932092380',
				'title'           => 'Test Product 1',
				'handle'          => 'test-product-1',
				'body_html'       => '<h1>Test Product</h1>',
				'vendor'          => 'Shopify',
				'product_type'    => 'Shirts',
				'published_at'    => '',
				'published_scope' => 'global',
				'template_suffix' => '',
				'tags'            => [
					'TEST',
					'RED',
					'FLEECE',
					'SALE',
					'NEW',
				],
				'options'         => [
					[
						'shopify_id' => '3490394803498',
						'name'       => 'Size',
						'position'   => 1,
						'values'     => [
							'XS',
							'S',
							'M',
							'L',
							'XL',
						]
					],
					[
						'shopify_id' => '34903903498',
						'name'       => 'Color',
						'position'   => 2,
						'values'     => [
							'Red',
							'Green',
							'Blue',
							'Purple',
							'Black',
						]
					],
					[
						'shopify_id' => '34903948038',
						'name'       => 'Material',
						'position'   => 3,
						'values'     => [
							'Fleece',
							'Cotton',
							'Leather',
							'Silk',
						]
					],

				],
				'metafields' => [
					[
						'shopify_id' => '349009222',
						'namespace'  => 'global',
						'key'        => 'size_chart',
						'value'      => 'https://google.com',
					],
					[
						'shopify_id' => '349009234322',
						'namespace'  => 'global',
						'key'        => 'youtube_video_url',
						'value'      => 'https://google.com',
					],
					[
						'shopify_id' => '3434349009222',
						'namespace'  => 'global',
						'key'        => 'sale_channel_url',
						'value'      => 'https://google.com',
					],
				],
				'variants' => [
					[
						'shopify_id'       => '398798731937',
						'title'            => 'M Black Fleece',
						'price'            => '200.99',
						'compare_at_price' => '599.99',
						'sku'              => 'SL-34566',
						'barcode'          => '39083094-309309083-393094831',
						'position'         => 1,
						'grams'            => '',
						'inventory_policy' => '',
						'inventory_management' => 'shopify',
						'inventory_quantity'   => 200,
						'old_inventory_quantity' => 198,
						'fulfillment_service'    => '',
						'requires_shipping'      => true,
						'taxable'                => true,
						'option1'                => 'M',
						'option2'                => 'Black',
						'option3'                => 'Fleece',
						'shopify_image_id'       => '',
						'weight'                 => '',
						'weight_unit'            => 'lbs',
					],
					[
						'shopify_id'       => '3987981937',
						'title'            => 'L Red Leather',
						'price'            => '2000.99',
						'compare_at_price' => '5099.99',
						'sku'              => 'SL-34566',
						'barcode'          => '39083094-309309083-393094831',
						'position'         => 1,
						'grams'            => '',
						'inventory_policy' => '',
						'inventory_management' => 'shopify',
						'inventory_quantity'   => 2000,
						'old_inventory_quantity' => 1980,
						'fulfillment_service'    => '',
						'requires_shipping'      => true,
						'taxable'                => true,
						'option1'                => 'L',
						'option2'                => 'Red',
						'option3'                => 'Leather',
						'shopify_image_id'       => '',
						'weight'                 => '',
						'weight_unit'            => 'lbs',
					],
					[
						'shopify_id'       => '398731937',
						'title'            => 'XL Purple Silk',
						'price'            => '400.99',
						'compare_at_price' => '699.99',
						'sku'              => 'SL-34566',
						'barcode'          => '39083094-309309083-393094831',
						'position'         => 1,
						'grams'            => '',
						'inventory_policy' => '',
						'inventory_management' => 'shopify',
						'inventory_quantity'   => 200,
						'old_inventory_quantity' => 198,
						'fulfillment_service'    => '',
						'requires_shipping'      => true,
						'taxable'                => true,
						'option1'                => 'XL',
						'option2'                => 'Purple',
						'option3'                => 'Silk',
						'shopify_image_id'       => '',
						'weight'                 => '',
						'weight_unit'            => 'lbs',
					],
				],
			],
			[
				'shopify_id'      => '329320090980',
				'title'           => 'Test Product 2',
				'handle'          => 'test-product-2',
				'body_html'       => '<h1>Test Product 2</h1>',
				'vendor'          => 'Shopify',
				'product_type'    => 'Shirts',
				'published_at'    => '',
				'published_scope' => 'global',
				'template_suffix' => '',
				'tags'            => [
					'TEST',
					'RED',
					'FLEECE',
					'SALE',
					'NEW',
				],
				'options'         => [
					[
						'shopify_id' => '3490394803498',
						'name'       => 'Size',
						'position'   => 1,
						'values'     => [
							'XS',
							'S',
							'M',
							'L',
							'XL',
						]
					],
					[
						'shopify_id' => '34903903498',
						'name'       => 'Color',
						'position'   => 2,
						'values'     => [
							'Red',
							'Green',
							'Blue',
							'Purple',
							'Black',
						]
					],
					[
						'shopify_id' => '34903948038',
						'name'       => 'Material',
						'position'   => 3,
						'values'     => [
							'Fleece',
							'Cotton',
							'Leather',
							'Silk',
						]
					],

				],
				'metafields' => [
					[
						'shopify_id' => '349009222',
						'namespace'  => 'global',
						'key'        => 'size_chart',
						'value'      => 'https://google.com',
					],
					[
						'shopify_id' => '349009234322',
						'namespace'  => 'global',
						'key'        => 'youtube_video_url',
						'value'      => 'https://google.com',
					],
					[
						'shopify_id' => '3434349009222',
						'namespace'  => 'global',
						'key'        => 'sale_channel_url',
						'value'      => 'https://google.com',
					],
				],
				'variants' => [
					[
						'shopify_id'       => '398798731937',
						'title'            => 'M Black Fleece',
						'price'            => '200.99',
						'compare_at_price' => '599.99',
						'sku'              => 'SL-34566',
						'barcode'          => '39083094-309309083-393094831',
						'position'         => 1,
						'grams'            => '',
						'inventory_policy' => '',
						'inventory_management' => 'shopify',
						'inventory_quantity'   => 200,
						'old_inventory_quantity' => 198,
						'fulfillment_service'    => '',
						'requires_shipping'      => true,
						'taxable'                => true,
						'option1'                => 'M',
						'option2'                => 'Black',
						'option3'                => 'Fleece',
						'shopify_image_id'       => '',
						'weight'                 => '',
						'weight_unit'            => 'lbs',
					],
					[
						'shopify_id'       => '3987981937',
						'title'            => 'L Red Leather',
						'price'            => '2000.99',
						'compare_at_price' => '5099.99',
						'sku'              => 'SL-34566',
						'barcode'          => '39083094-309309083-393094831',
						'position'         => 1,
						'grams'            => '',
						'inventory_policy' => '',
						'inventory_management' => 'shopify',
						'inventory_quantity'   => 2000,
						'old_inventory_quantity' => 1980,
						'fulfillment_service'    => '',
						'requires_shipping'      => true,
						'taxable'                => true,
						'option1'                => 'L',
						'option2'                => 'Red',
						'option3'                => 'Leather',
						'shopify_image_id'       => '',
						'weight'                 => '',
						'weight_unit'            => 'lbs',
					],
					[
						'shopify_id'       => '398731937',
						'title'            => 'XL Purple Silk',
						'price'            => '400.99',
						'compare_at_price' => '699.99',
						'sku'              => 'SL-34566',
						'barcode'          => '39083094-309309083-393094831',
						'position'         => 1,
						'grams'            => '',
						'inventory_policy' => '',
						'inventory_management' => 'shopify',
						'inventory_quantity'   => 200,
						'old_inventory_quantity' => 198,
						'fulfillment_service'    => '',
						'requires_shipping'      => true,
						'taxable'                => true,
						'option1'                => 'XL',
						'option2'                => 'Purple',
						'option3'                => 'Silk',
						'shopify_image_id'       => '',
						'weight'                 => '',
						'weight_unit'            => 'lbs',
					],
				],
			],
			[
				'shopify_id'      => '3293297962380',
				'title'           => 'Test Product 3',
				'handle'          => 'test-product-3',
				'body_html'       => '<h1>Test Product 3</h1>',
				'vendor'          => 'Shopify',
				'product_type'    => 'Shirts',
				'published_at'    => '',
				'published_scope' => 'global',
				'template_suffix' => '',
				'tags'            => [
					'TEST',
					'RED',
					'FLEECE',
					'SALE',
					'NEW',
				],
				'options'         => [
					[
						'shopify_id' => '3490394803498',
						'name'       => 'Size',
						'position'   => 1,
						'values'     => [
							'XS',
							'S',
							'M',
							'L',
							'XL',
						]
					],
					[
						'shopify_id' => '34903903498',
						'name'       => 'Color',
						'position'   => 2,
						'values'     => [
							'Red',
							'Green',
							'Blue',
							'Purple',
							'Black',
						]
					],
					[
						'shopify_id' => '34903948038',
						'name'       => 'Material',
						'position'   => 3,
						'values'     => [
							'Fleece',
							'Cotton',
							'Leather',
							'Silk',
						]
					],

				],
				'metafields' => [
					[
						'shopify_id' => '349009222',
						'namespace'  => 'global',
						'key'        => 'size_chart',
						'value'      => 'https://google.com',
					],
					[
						'shopify_id' => '349009234322',
						'namespace'  => 'global',
						'key'        => 'youtube_video_url',
						'value'      => 'https://google.com',
					],
					[
						'shopify_id' => '3434349009222',
						'namespace'  => 'global',
						'key'        => 'sale_channel_url',
						'value'      => 'https://google.com',
					],
				],
				'variants' => [
					[
						'shopify_id'       => '398798731937',
						'title'            => 'M Black Fleece',
						'price'            => '200.99',
						'compare_at_price' => '599.99',
						'sku'              => 'SL-34566',
						'barcode'          => '39083094-309309083-393094831',
						'position'         => 1,
						'grams'            => '',
						'inventory_policy' => '',
						'inventory_management' => 'shopify',
						'inventory_quantity'   => 200,
						'old_inventory_quantity' => 198,
						'fulfillment_service'    => '',
						'requires_shipping'      => true,
						'taxable'                => true,
						'option1'                => 'M',
						'option2'                => 'Black',
						'option3'                => 'Fleece',
						'shopify_image_id'       => '',
						'weight'                 => '',
						'weight_unit'            => 'lbs',
					],
					[
						'shopify_id'       => '3987981937',
						'title'            => 'L Red Leather',
						'price'            => '2000.99',
						'compare_at_price' => '5099.99',
						'sku'              => 'SL-34566',
						'barcode'          => '39083094-309309083-393094831',
						'position'         => 1,
						'grams'            => '',
						'inventory_policy' => '',
						'inventory_management' => 'shopify',
						'inventory_quantity'   => 2000,
						'old_inventory_quantity' => 1980,
						'fulfillment_service'    => '',
						'requires_shipping'      => true,
						'taxable'                => true,
						'option1'                => 'L',
						'option2'                => 'Red',
						'option3'                => 'Leather',
						'shopify_image_id'       => '',
						'weight'                 => '',
						'weight_unit'            => 'lbs',
					],
					[
						'shopify_id'       => '398731937',
						'title'            => 'XL Purple Silk',
						'price'            => '400.99',
						'compare_at_price' => '699.99',
						'sku'              => 'SL-34566',
						'barcode'          => '39083094-309309083-393094831',
						'position'         => 1,
						'grams'            => '',
						'inventory_policy' => '',
						'inventory_management' => 'shopify',
						'inventory_quantity'   => 200,
						'old_inventory_quantity' => 198,
						'fulfillment_service'    => '',
						'requires_shipping'      => true,
						'taxable'                => true,
						'option1'                => 'XL',
						'option2'                => 'Purple',
						'option3'                => 'Silk',
						'shopify_image_id'       => '',
						'weight'                 => '',
						'weight_unit'            => 'lbs',
					],
				],
			],
		];


		
		DB::table('s_products')->delete();

		foreach($seedData as $seedProduct)
		{
			// products
			$product = new Product;
			$product->shop_id         = $shopId;
			$product->shopify_id      = $seedProduct['shopify_id'];
			$product->title           = $seedProduct['title'];
			$product->handle          = $seedProduct['handle'];
			$product->body_html       = $seedProduct['body_html'];
			$product->vendor          = $seedProduct['vendor'];
			$product->product_type    = $seedProduct['product_type'];
			$product->published_at    = $seedProduct['published_at'];
			$product->published_scope = $seedProduct['published_scope'];
			$product->template_suffix = $seedProduct['template_suffix'];
			$product->tags            = implode(',', $seedProduct['tags']);
			$product->save();


			// options
			if(count($seedProduct['options']))
			{
				foreach($seedProduct['options'] as $seedOption)
				{
					$option = new ProductOption;
					$option->product_id         = $product->id;
					$option->shopify_id         = $seedOption['shopify_id'];
					$option->shopify_product_id = $product->shopify_id;
					$option->name               = $seedOption['name'];
					$option->position           = $seedOption['position'];
					$option->values             = implode(',', $seedOption['values']);
					$option->save();
				}
			}


			// metafields
			if(count($seedProduct['metafields']))
			{
				foreach($seedProduct['metafields'] as $seedMetafield)
				{
					$metafield = new ProductMetafield;
					$metafield->product_id         = $product->id;
					$metafield->shopify_id         = $seedMetafield['shopify_id'];
					$metafield->shopify_product_id = $product->shopify_id;
					$metafield->namespace          = $seedMetafield['namespace'];
					$metafield->key                = $seedMetafield['key'];
					$metafield->value              = $seedMetafield['value'];
					$metafield->save();
				}
			}


			// variants
			if(count($seedProduct['variants']))
			{
				foreach($seedProduct['variants'] as $seedVariant)
				{
					$variant = new ProductVariant;
					$variant->product_id              = $product->id;
					$variant->shopify_id              = $seedVariant['shopify_id'];
					$variant->shopify_product_id      = $product->shopify_id;
					$variant->title                   = $seedVariant['title'];
					$variant->price                   = $seedVariant['price'];
					$variant->compare_at_price        = $seedVariant['compare_at_price'];
					$variant->sku                     = $seedVariant['sku'];
					$variant->barcode                 = $seedVariant['barcode'];
					$variant->position                = $seedVariant['position'];
					$variant->grams                   = $seedVariant['grams'];
					$variant->inventory_policy        = $seedVariant['inventory_policy'];
					$variant->inventory_management    = $seedVariant['inventory_management'];
					$variant->inventory_quantity      = $seedVariant['inventory_quantity'];
					$variant->old_inventory_quantity  = $seedVariant['old_inventory_quantity'];
					$variant->fulfillment_service     = $seedVariant['fulfillment_service'];
					$variant->requires_shipping       = $seedVariant['requires_shipping'];
					$variant->taxable                 = $seedVariant['taxable'];
					$variant->option1                 = $seedVariant['option1'];
					$variant->option2                 = $seedVariant['option2'];
					$variant->option3                 = $seedVariant['option3'];
					$variant->shopify_image_id        = $seedVariant['shopify_image_id'];
					$variant->weight                  = $seedVariant['weight'];
					$variant->weight_unit             = $seedVariant['weight_unit'];
					$variant->save();

				}
			}


		}

	}

}
