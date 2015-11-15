<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiKeysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		// api key access levels
		Schema::create('api_access_levels', function(Blueprint $t) {
			$t->increments('id');

			$t->string('title');
			$t->integer('level');
			$t->integer('request_limit');
			$t->string('interval_type'); // minute, day, year, etc
			$t->integer('interval_value'); // 2, 1, 4, etc

			$t->timestamps();
		});
		

		// api keys
		Schema::create('api_keys', function(Blueprint $t) {
			$t->increments('id');

			// The shop
			$t->integer('shop_id')->unsigned();
			$t->foreign('shop_id')->references('id')->on('s_shops')->onDelete('cascade');

			$t->string('public_key');

			// The API access level
			$t->integer('access_level_id')->unsigned();
			$t->foreign('access_level_id')->references('id')->on('api_access_levels');


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
		Schema::drop('api_keys');
		Schema::drop('api_access_levels');
	}

}
