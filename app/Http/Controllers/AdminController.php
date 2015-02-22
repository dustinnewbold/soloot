<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Importer;
use App\Models\Option;

use DB, Redirect, Input;

class AdminController extends Controller {

	private $importer;
	public function __construct(Importer $importer) {
		$this->importer = $importer;
		// $this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$dboptions = Option::all();
		$options = [];

		foreach ( $dboptions as $option ) {
			$options[$option->key] = $option;
		}
		$options = (object)$options;

		return view('admin.index', compact('options'));
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
		$xml = Input::get('xml');
		$this->importer->storeXML($xml);
		$this->importer->import($xml);
		return view('admin.index');
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
}
