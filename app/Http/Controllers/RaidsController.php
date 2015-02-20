<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Raid;
use App\Models\MClass;
use App\Models\Zone;
use App\Models\Difficulty;

use Illuminate\Http\Request;
use DB, Cache;

class RaidsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$raids = Raid::orderBy('start_time', 'DESC')->get();
		foreach ( $raids as $raid ) {
			$members = DB::table('member_raid')->where('raid_id', $raid->id)->count();
			$raid->members = $members;

			$items = DB::table('item_raid')->where('raid_id', $raid->id)->count();
			$raid->items = $items;

			$zone = Zone::find($raid->zone_id);
			$raid->zone = $zone;

			$difficulty = Difficulty::find($raid->difficulty->id);
			$raid->difficulty = $difficulty;
		}

		return view('raids.index', compact('raids'));
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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$raid = Raid::with('zone')->findOrFail($id);
		$members = DB::table('member_raid')->where('raid_id', $raid->id)->leftJoin('members', 'member_raid.member_id', '=', 'members.id')->get();
		$dbloot = DB::table('item_raid')->where('raid_id', $raid->id)->leftJoin('items', 'item_raid.item_id', '=', 'items.id')->get();
		$classes = MClass::asArray();

		// Set up loots
		$loots = [];
		foreach ( $dbloot as $loot ) {
			$loots[$loot->member_id][] = $loot;
		}
		
		return view('raids.show', compact('raid', 'members', 'loots', 'classes'));
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

}
