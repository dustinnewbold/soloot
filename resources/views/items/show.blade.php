@extends('master')

@section('breadcrumbs')
	<nav class="breadcrumbs">
		<ul>
			<li>
				<a href="{{ url('/') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/') }}">Items</a>
			</li>
			<li>
				{{ $item->name }}
			</li>
		</ul>
	</nav>
	<div class="clear"></div>
@stop

@section('content')
	<h1>
		{{ $item->name }}
	</h1>

	<h3>
		Item History
	</h3>
	<table>
		<thead>
			<tr>
				<th>
					Member
				</th>
				<th>
					Loot
				</th>
				<th>
					Date Received
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $history as $loot )
				<tr data-href="{{ route('members.show', strtolower($loot->name)) }}">
					<td class="{{ strtolower($classes[$loot->class_id]->name) }}">
						{{ $loot->name }}
					</td>
					<td>
						<a href="https://www.wowhead.com/{{ lootToLink($loot->idstring) }}" rel="{{ lootToLink($loot->idstring) }}" target="_blank" class="stopprop"></a>
					</td>
					<td>
						{{ date('F d, Y', $loot->time) }}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop