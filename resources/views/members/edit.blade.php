@extends('master')

@section('content')
	<h3>
		Editing
	</h3>
	<h1>
		{{ $member->name }}
	</h1>

	<form method="POST" action="{{ route('members.update', strtolower($member->name)) }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
		<input type="hidden" name="_method" value="PUT" />

		<fieldset>
			<label>
				Cooldown
			</label>
			<input type="number" name="cooldown" value="{{ $member->cooldown }}" />
		</fieldset>

		<input type="submit" value="Save" />
	</form>
@stop