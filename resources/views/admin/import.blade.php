@extends('master')

@section('content')
	<form method="POST" action="{{ route('admin.store') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<textarea name="xml" cols="100" rows="20"></textarea>
		<input type="submit">
	</form>
@stop