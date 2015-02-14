<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->integer('cooldown')->default(0);

			$table->integer('race_id')->unsigned()->nullable();
			$table->foreign('race_id')->references('id')->on('races')->onDelete('cascade');

			$table->integer('class_id')->unsigned()->nullable();
			$table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');

			$table->integer('sex')->unsigned()->nullable();
			$table->integer('level')->unsigned()->nullable();

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
		Schema::drop('members');
	}

}
