<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boss extends Model {

	protected $fillable = ['name', 'zone_id'];
	protected $hidden = ['zone_id'];

	public function zone() {
		return $this->belongsTo('App\Models\Zone');
	}

}
