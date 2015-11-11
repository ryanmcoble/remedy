<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCacheTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// shopify products cache
		Schema::create('s_products', function(Blueprint $t) {
			$t->increments('id');

			$t->integer('shop_id')->unsigned();
			$t->foreign('shop_id')->references('id')->on('s_shops')->onDelete('cascade');

			$t->string('shopify_id');

			$t->string('title');
			$t->string('handle');
			$t->text('body_html');
			$t->string('vendor');
			$t->string('product_type');
			$t->timestamp('published_at');
			$t->string('published_scope');
			$t->string('template_suffix');
			$t->string('tags');

			$t->timestamps();
		});

		// shopify product variants cache
		Schema::create('s_product_variants', function(Blueprint $t) {
			$t->increments('id');

			$t->integer('product_id')->unsigned();
			$t->foreign('product_id')->references('id')->on('s_products')->onDelete('cascade');

			$t->string('shopify_id');
			$t->string('shopify_product_id');

			$t->string('title');
			
			$t->string('price');
			$t->string('compare_at_price');
			
			$t->string('sku');
			$t->string('barcode');
			
			$t->integer('position');
			$t->string('grams');
			
			$t->string('inventory_policy');
			$t->string('inventory_management');
			$t->integer('inventory_quantity');
			$t->integer('old_inventory_quantity');
			
			$t->string('fulfillment_service');
			$t->boolean('requires_shipping');
			
			$t->boolean('taxable');
			
			$t->string('option1');
			$t->string('option2');
			$t->string('option3');
			
			$t->string('shopify_image_id');
			
			$t->string('weight');
			$t->string('weight_unit');

			$t->timestamps();
		});

		// shopify product images cache
		Schema::create('s_product_images', function(Blueprint $t) {
			$t->increments('id');

			$t->integer('product_id')->unsigned();
			$t->foreign('product_id')->references('id')->on('s_products')->onDelete('cascade');

			$t->string('shopify_id');
			$t->string('shopify_product_id');

			$t->integer('position');
			$t->string('src');
			$t->text('variant_ids'); // comma separated

			$t->timestamps();
		});

		// shopify product options cache
		Schema::create('s_product_options', function(Blueprint $t) {
			$t->increments('id');

			$t->integer('product_id')->unsigned();
			$t->foreign('product_id')->references('id')->on('s_products')->onDelete('cascade');

			$t->string('shopify_id');
			$t->string('shopify_product_id');

			$t->string('name');
			$t->integer('position');
			$t->string('values'); // comma separated

			$t->timestamps();
		});

		// shopify product metafields cache
		Schema::create('s_product_metafields', function(Blueprint $t) {
			$t->increments('id');

			$t->integer('product_id')->unsigned();
			$t->foreign('product_id')->references('id')->on('s_products')->onDelete('cascade');

			$t->string('shopify_id');
			$t->string('shopify_product_id');

			$t->string('namespace');
			$t->string('key');
			$t->string('value');

			$t->timestamps();
		});

		// shopify product metafields cache
		Schema::create('s_product_variant_metafields', function(Blueprint $t) {
			$t->increments('id');

			$t->integer('variant_id')->unsigned();
			$t->foreign('variant_id')->references('id')->on('s_product_variants')->onDelete('cascade');

			$t->string('shopify_id');
			$t->string('shopify_variant_id');

			$t->string('namespace');
			$t->string('key');
			$t->string('value');

			$t->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// drop the tables
		Schema::drop('s_products');
		Schema::drop('s_product_variants');
		Schema::drop('s_product_images');
		Schema::drop('s_product_options');
		Schema::drop('s_product_metafields');
		Schema::drop('s_product_variant_metafields');

	}

}
