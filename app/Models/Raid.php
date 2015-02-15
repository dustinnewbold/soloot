<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Raid extends Model {

	public function difficulty() {
		return $this->belongsTo('App\Models\Difficulty');
	}

	public function zone() {
		return $this->belongsTo('App\Models\Zone');
	}

	public function members() {
		return $this->belongsToMany('App\Models\Member');
	}

	public function items() {
		return $this->belongsToMany('App\Models\Item');
	}


	public function getLoot($memberID = null) {
		if ( $memberID === null ) {
			return $this->items()->get();
		}

		return $this->items()->where('member_id', $memberID)->get();
	}

}




// [
// 	{
// 		'id' => 1,
// 		'name' => 'Kasath',
// 		'cooldown' => true,
// 		'raids' => [
// 			{},
// 			{},
// 			{},
// 			{},
// 		],
// 	}
// ]