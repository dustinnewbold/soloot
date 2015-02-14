<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

	protected $fillable = ['name', 'idstring'];

	public function getLink() {
		$id = (int)$this->idstring;
		$params = explode(':', $this->idstring);
		$bonuses = array_splice($params, 12);
		$bonusString = implode($bonuses, ':');

		return 'item=' . $id . '&bonus=' . $bonusString;
	}

}
