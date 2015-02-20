@extends('master')

@section('breadcrumbs')
	<nav class="breadcrumbs">
		<ul>
			<li>
				<a href="{{ url('/') }}">Home</a>
			</li>
			<li>
				<a href="{{ route('admin.index') }}">Admin</a>
			</li>
			<li>
				Import
			</li>
		</ul>
	</nav>
	<div class="clear"></div>
@stop

@section('content')
	<form method="POST" action="{{ route('admin.store') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<fieldset>
			<label>
				XML Import:
			</label>
			<p class="gray">
				Copy and paste your XML into the box below
			</p>
			<textarea name="xml" cols="100" rows="20"></textarea>
		</fieldset>
		<input type="submit">
	</form>
@stop