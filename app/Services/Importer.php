<?php namespace App\Services;

use App\Models\Raid;
use App\Models\Zone;
use App\Models\Boss;
use App\Models\Item;
use App\Models\Member;
use App\Models\Difficulty;
use App\Models\Race;
use App\Models\MClass;
use App\Models\Option;

use DB;

class Importer {
	private $raidcd = 3;
	public function __construct() {
		$options = DB::table('options')->where('key', 'cooldown')->first();
		if ( $options ) {
			$this->raidcd = (int)$options->value;
		}
	}

	public function storeXML($xml) {
		$checksum = md5($xml);
		$table = DB::table('xml');
		$check = $table->where('checksum', $checksum)->first();

		if ( $check ) {
			return Redirect::back()->with('message', 'This raid was already uploaded')->with('type', 'error');
		}

		$raid = simplexml_load_string($xml);
		$raidtime = (int)$raid->raiddata->zones->zone->enter;

		$table->insert(array(
			'xml' => $xml,
			'checksum' => $checksum,
			'raid_time' => $raidtime,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		));
	}

	public function import($xml) {
		$raiddata = simplexml_load_string($xml);

		// First lets check to see if this is a duplicate raid
		$zone = Zone::firstOrCreate(['name' => $raiddata->raiddata->zones->zone->name]);
		$difficulty = Difficulty::firstOrCreate(['id' => $raiddata->raiddata->zones->zone->difficulty]);
		$duplicate = Raid::where('start_time', $raiddata->raiddata->zones->zone->enter)
						 ->where('end_time', $raiddata->raiddata->zones->zone->leave)
						 ->where('zone_id', $zone->id)
						 ->where('difficulty_id', $difficulty->id)->first();

		if ( $duplicate ) {
			return Redirect::back()->with('message', 'This raid was already uploaded');
		}

		$logger = Member::firstOrCreate(['name' => $raiddata->head->gameinfo->charactername]);
		$raid = new Raid();
		$raid->zone_id = $zone->id;
		$raid->member_id = $logger->id;
		$raid->difficulty_id = $difficulty->id;
		$raid->start_time = $raiddata->raiddata->zones->zone->enter;
		$raid->end_time = $raiddata->raiddata->zones->zone->leave;
		$raid->save();
		// $raid = $duplicate;

		foreach ( $raiddata->raiddata->members->member as $xmlMember ) {
			$member = Member::firstOrCreate(['name' => $xmlMember->name]);
			$race = Race::firstOrCreate(['name' => $xmlMember->race]);
			$class = MClass::firstOrCreate(['name' => $xmlMember->class]);
			$member->race_id = $race->id;
			$member->class_id = $class->id;
			$member->sex = $xmlMember->sex;

			if ( $member->cooldown ) {
				$member->cooldown--;
			}

			if ( $xmlMember->level > 0 ) {
				$member->level = $xmlMember->level;
			}
			$member->save();

			$join = time();
			$leave = time();

			foreach ( $xmlMember->times->time as $time ) {
				if ( $time->attributes()['type'] == 'join' ) {
					$join = (string)$time;
				} else {
					$leave = (string)$time;
				}
			}

			$raid->members()->attach($member->id, ['join_time' => $join, 'leave_time' => $leave]);
		}

		foreach ( $raiddata->raiddata->items->item as $loot ) {
			$member = Member::firstOrCreate(['name' => $loot->member]);
			$boss = Boss::firstOrCreate(['name' => (string)$loot->boss, 'zone_id' => $zone->id]);
			$item = Item::firstOrCreate(['name' => (string)$loot->name, 'wowid' => (int)$loot->itemid]);
			$member->cooldown = $this->raidcd;
			$member->save();

			$raid->items()->attach($item->id, ['member_id' => $member->id,
											  	'raid_id' => $raid->id,
											  	'boss_id' => $boss->id,
											  	'idstring' => $loot->itemid,
											  	'cost' => (string)$loot->cost,
											  	'time' => (string)$loot->time,
											  ]);
		}

		return true;
	}
}