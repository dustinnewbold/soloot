<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChecksumToXmlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('xml', function(Blueprint $table)
		{
			$table->string('checksum', 32)->after('xml');
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
			$table->dropColumn('checksum');
		});
	}

}
