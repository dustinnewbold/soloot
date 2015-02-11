<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model {

	public function bosses() {
		return $this->hasMany('App\Models\Boss');
	}

}
