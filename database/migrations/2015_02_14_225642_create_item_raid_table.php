<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemRaidTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_raid', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('item_id')->unsigned();
			$table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

			$table->integer('member_id')->unsigned();
			$table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');

			$table->integer('raid_id')->unsigned();
			$table->foreign('raid_id')->references('id')->on('raids')->onDelete('cascade');

			$table->integer('boss_id')->unsigned();
			$table->foreign('boss_id')->references('id')->on('bosses')->onDelete('cascade');

			$table->integer('cost');
			$table->integer('time')->unsigned();

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
		Schema::drop('item_raid');
	}

}
