<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBossesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bosses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->integer('zone_id')->unsigned();
			$table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
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
		Schema::drop('bosses');
	}

}
