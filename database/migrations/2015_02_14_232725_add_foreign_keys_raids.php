<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysRaids extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('raids', function(Blueprint $table)
		{
			$table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
			$table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
			$table->foreign('difficulty_id')->references('id')->on('difficulties')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('raids', function(Blueprint $table)
		{
			$table->dropForeign('raids_zone_id_foreign');
			$table->dropForeign('raids_member_id_foreign');
			$table->dropForeign('raids_difficulty_id_foreign');
		});
	}

}
