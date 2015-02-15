<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Raid extends Model {

	public function zone() {
		return $this->belongsTo('Zone');
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

		// return $this->items()->where('')
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