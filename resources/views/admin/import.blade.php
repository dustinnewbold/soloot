@extends('master')

@section('content')
	<form method="POST" action="{{ route('admin.store') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<fieldset>
			<label>
				XML Import
			</label>
			<p>
				Copy and paste your XML into the box below
			</p>
			<textarea name="xml" cols="100" rows="20"></textarea>
		</fieldset>
		<input type="submit">
	</form>
@stop