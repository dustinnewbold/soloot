<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;

use App\Models\Member;
use App\Models\Raid;
use App\Models\MClass;

class TrackerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$members = Member::where('active', '>', '0')->orderBy('name', 'ASC')->get();
		$dbloots = DB::table('item_raid')->leftJoin('items', 'item_raid.item_id', '=', 'items.id')->orderBy('time', 'DESC')->get();
		$loots = [];

		foreach ( $dbloots as $loot ) {
			if ( isset($loots[$loot->member_id]) ) {
				continue;
			}
			$loots[$loot->member_id] = $loot;
		}


		// Get attendance
		$dbraids = DB::table('raids')->take(12)->get();
		$raidAttendance = [];
		$totalRaids = count($dbraids);
		foreach ( $dbraids as $raid ) {
			$attendance = DB::table('member_raid')->where('raid_id', $raid->id)->get();
			foreach ( $attendance as $member ) {
				if ( empty($raidAttendance[$member->member_id]) ) {
					$raidAttendance[$member->member_id] = 0;
				}
				$raidAttendance[$member->member_id]++;
			}
		}

		$classes = MClass::asArray();
		return view('tracker.index', compact('members', 'loots', 'classes', 'raidAttendance', 'totalRaids'));
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

}
