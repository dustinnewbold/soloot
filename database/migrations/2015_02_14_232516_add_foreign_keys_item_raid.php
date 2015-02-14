<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysItemRaid extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('item_raid', function(Blueprint $table)
		{
			$table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
			$table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
			$table->foreign('raid_id')->references('id')->on('raids')->onDelete('cascade');
			$table->foreign('boss_id')->references('id')->on('bosses')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('item_raid', function(Blueprint $table)
		{
			//
		});
	}

}
