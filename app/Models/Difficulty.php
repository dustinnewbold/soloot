<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Config;

class Difficulty extends Model {

	protected $fillable = ['id'];

	public function getNameAttribute($name) {
		if ( empty($name) ) {
			if ( config('loot.difficulties.' . $this->id) ) {
				return config('loot.difficulties.' . $this->id);
			}
		}

		return $name;
	}

}
