<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaidsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('raids', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('zone_id')->unsigned();
			$table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');

			$table->integer('member_id')->unsigned();
			$table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');

			$table->integer('difficulty_id')->unsigned();
			$table->foreign('difficulty_id')->references('id')->on('difficulties')->onDelete('cascade');

			$table->integer('start_time')->unsigned();
			$table->integer('end_time')->unsigned();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('raids');
	}

}
