<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Member extends Model {

	protected $fillable = ['name'];

	public function raids() {
		return $this->belongsToMany('App\Models\Raid');
	}

	public function recent() {
		$loot = [];
		$raids = Raid::take(4)->get();
		foreach ( $raids as $raid ) {
			$items = DB::table('item_raid')->where('raid_id', $raid->id)->where('member_id', $this->id)->get();

			if ( ! $items ) {
				$loot[] = [];
			} else {
				$loots = [];
				foreach ( $items as $item ) {
					$loots[] = Item::find($item->id);
				}
				$loot[] = $loots;
			}
		}


		$return = [
			'cooldown' => 0,
			'attendance' => '100% 100% 100%',
			'loot' => $loot,
		];


		return $return;
	}

}
