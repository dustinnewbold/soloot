<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Member;
use App\Models\Raid;
use DB;

use Illuminate\Http\Request;

class MembersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
	 * @param  int  $name
	 * @return Response
	 */
	public function show($name)
	{
		$member = Member::where('name', $name)->first();
		$raids = DB::table('member_raid')->where('member_raid.member_id', $member->id)->leftJoin('raids', 'member_raid.raid_id', '=', 'raids.id')->orderBy('start_time', 'DESC')->get();
		$dbloot = DB::table('item_raid')->where('member_id', $member->id)->leftJoin('items', 'item_raid.item_id', '=', 'items.id')->get();
		$loots = [];

		foreach ( $dbloot as $loot ) {
			$loots[$loot->raid_id][] = $loot;
		}

		return view('members.show', compact('member', 'raids', 'loots'));
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
