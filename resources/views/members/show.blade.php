@extends('master')

@section('breadcrumbs')
	<nav class="breadcrumbs">
		<ul>
			<li>
				<a href="{{ url('/') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/') }}">Members</a>
			</li>
			<li>
				{{ $member->name }}
			</li>
		</ul>
	</nav>
	<div class="clear"></div>
@stop

@section('content')
	<h1>
		{{ $member->name }}
	</h1>

	@if ( $member->cooldown <= 0 )
		<h2 class="green">
			OFF COOLDOWN	
		</h2>
	@else
		<h2 class="red">
			Cooldown
			<span class="text-small">
				with {{ $member->cooldown }} raids to go
			</span>
		</h2>
	@endif

	<h3>
		Raid History
	</h3>
	<table>
		<thead>
			<tr>
				<th>
					Raid
				</th>
				<th>
					Date
				</th>
				<th>
					Loot
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $raids as $raid )
				<tr data-href="{{ route('raids.show', $raid->id) }}">
					<td>
						{{ App\Models\Zone::find($raid->zone_id)->name }}
						({{ App\Models\Difficulty::find($raid->difficulty_id)->name }})
					</td>
					<td>
						{{ date('F d, Y', $raid->start_time) }}
					</td>
					<td>
						@if ( empty($loots[$raid->id]) )
							No Loot
						@else
							@foreach ( $loots[$raid->id] as $loot )
								<a href="{{ route('items.show', $loot->wowid) }}" rel="{{ lootTolink($loot->idstring) }}" class="loot"></a>
							@endforeach
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop