<?php

use Illuminate\Database\Seeder;

use App\Models\Member;

class MembersTableSeeder extends Seeder {
	public function run() {
		DB::table('members')->delete();
	}
}