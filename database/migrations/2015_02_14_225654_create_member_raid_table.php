<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberRaidTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('member_raid', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('raid_id')->unsigned();
			$table->integer('member_id')->unsigned();
			$table->integer('join_time')->unsigned();
			$table->integer('leave_time')->unsigned();
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
		Schema::drop('member_raid');
	}

}
