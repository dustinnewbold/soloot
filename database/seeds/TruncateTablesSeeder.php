<?php

use Illuminate\Database\Seeder;

class TruncateTablesSeeder extends Seeder {
	public function run() {
		DB::table('bosses')->delete();
	}
}