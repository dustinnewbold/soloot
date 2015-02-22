@extends('master')

@section('breadcrumbs')
	<nav class="breadcrumbs">
		<ul>
			<li>
				<a href="{{ url('/') }}">Home</a>
			</li>
			<li>
				Admin
			</li>
		</ul>
	</nav>
	<div class="clear"></div>
@stop

@section('content')
	<h2>
		Admin
	</h2>
	<a href="{{ route('admin.import') }}" class="btn btn-blue btn-block">
		Import
	</a>
	<div class="clear"></div>

	<form method="POST" action="{{ route('admin.index') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
		<fieldset>
			<label>
				Raids for Cooldown:
			</label>
			<p>
				Changing this only affects future raid uploads.
			</p>
			<input type="number" name="cooldown" value="{{ $options->cooldown->value }}" />
		</fieldset>

		<input type="submit" value="Save" />
	</form>

	<h2>
		Re-index
	</h2>
	<div class="alert alert-warning">
		<p class="bottom">
			Re-indexing will remove all raid data and reimport all data again from the beginning. This will put all XML imports through current raid logic.
		</p>
	</div>
	<div class="alert alert-error">
		<p class="bottom">
			Re-indexing is not yet implemented through the UI. You must run loot:reindex from the command line to reindex.
		</p>
	</div>
	<form>
		<input type="submit" value="Re-index" />
	</form>
@stop