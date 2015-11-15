<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// api logs
		Schema::create('api_logs', function(Blueprint $t) {
			$t->increments('id');

			$t->integer('api_key_id')->unsigned();
			$t->foreign('api_key_id')->references('id')->on('api_keys')->onDelete('cascade');

			$t->string('status');
			$t->string('message');
			$t->string('ip_address');

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
		Schema::drop('api_logs');
	}

}
