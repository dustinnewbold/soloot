<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysMemberRaid extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('member_raid', function(Blueprint $table)
		{
			$table->foreign('raid_id')->references('id')->on('raids')->onDelete('cascade');
			$table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('member_raid', function(Blueprint $table)
		{
			//
		});
	}

}
