<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// s_ - means shopify-related data
		Schema::create('s_shops', function(Blueprint $t){
			$t->increments('id');
			$t->string('domain');
			$t->string('access_token');
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
		//
		Schema::drop('s_shops');
	}

}
