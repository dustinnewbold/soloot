<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRaidTimeToXmlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('xml', function(Blueprint $table)
		{
			$table->integer('raid_time')->after('checksum');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('xml', function(Blueprint $table)
		{
			$table->dropColumn('raid_time');
		});
	}

}
