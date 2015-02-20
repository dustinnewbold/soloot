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
	ADMIN INDEX
@stop