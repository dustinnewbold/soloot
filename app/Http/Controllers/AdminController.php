<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Raid;
use App\Models\Zone;
use App\Models\Boss;
use App\Models\Item;
use App\Models\Member;
use App\Models\Difficulty;
use App\Models\Race;
use App\Models\MClass;

class AdminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->import(file_get_contents(base_path() . '/database/xml/sampleA.xml'));
		$this->import(file_get_contents(base_path() . '/database/xml/sampleB.xml'));
		$this->import(file_get_contents(base_path() . '/database/xml/sampleC.xml'));
		$this->import(file_get_contents(base_path() . '/database/xml/sampleD.xml'));
		$this->import(file_get_contents(base_path() . '/database/xml/sampleE.xml'));

		return view('admin.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$raiddata = \Input::get('xml');
		$raiddata = simplexml_load_string($raiddata);

		$zone = null;
		$raid = null;

		foreach ( $raiddata->raiddata->zones->zone as $zone ) {
			return Zone::where('name', $zone->name)->get();
		}
		return \Input::all();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	public function viewImport() {
		return view('admin.import');
	}


	private function import($xml) {
		$raiddata = simplexml_load_string($xml);

		// First lets check to see if this is a duplicate raid
		$zone = Zone::firstOrCreate(['name' => $raiddata->raiddata->zones->zone->name]);
		$difficulty = Difficulty::firstOrCreate(['id' => $raiddata->raiddata->zones->zone->difficulty]);
		$duplicate = Raid::where('start_time', $raiddata->raiddata->zones->zone->enter)
						 ->where('end_time', $raiddata->raiddata->zones->zone->leave)
						 ->where('zone_id', $zone->id)
						 ->where('difficulty_id', $difficulty->id)->first();

		if ( $duplicate ) {
			dd('This is a duplicate entry');
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
			$member->race = $race->id;
			$member->sex = $xmlMember->sex;

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
			$item = Item::firstOrCreate(['name' => $loot->name, 'idstring' => $loot->itemid]);

			$raid->items()->attach($item->id, ['member_id' => $member->id,
											  	'raid_id' => $raid->id,
											  	'boss_id' => $boss->id,
											  	'cost' => (string)$loot->cost,
											  	'time' => (string)$loot->time,
											  ]);
		}

		return view('admin.index');
	}

}
