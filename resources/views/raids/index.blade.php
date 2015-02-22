@extends('master')

@section('breadcrumbs')
	<nav class="breadcrumbs">
		<ul>
			<li>
				<a href="{{ url('/') }}">Home</a>
			</li>
			<li>
				Raids
			</li>
		</ul>
	</nav>
	<div class="clear"></div>
@stop

@section('title', 'Raid History')
@section('content')
	<h1>
		Raid History
	</h1>
	<table>
		<thead>
			<tr>
				<th>
					Zone
				</th>
				<th>
					Difficulty
				</th>
				<th>
					Date
				</th>
				<th>
					Members
				</th>
				<th>
					Upgrades
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $raids as $raid )
				<tr data-href="{{ route('raids.show', $raid->id) }}">
					<td>
						{{ $raid->zone->name }}
					</td>
					<td class="{{ strtolower($raid->difficulty->name) }}">
						{{ $raid->difficulty->name }}
					</td>
					<td>
						{{ date('F d, Y', $raid->start_time) }}
					</td>
					<td>
						{{ $raid->members }}
					</td>
					<td>
						{{ $raid->items }}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop