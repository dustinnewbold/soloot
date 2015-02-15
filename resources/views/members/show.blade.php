@extends('master')

@section('content')
	<h1>
		{{ $member->name }}
	</h1>

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
				<tr>
					<td>
						{{ $raid->zone->name }}
						({{ $raid->difficulty->name }})
					</td>
					<td>
						{{ date('F d, Y', $raid->start_time) }}
					</td>
					<td>
						@if ( empty($loots[$raid->id]) )
							No Loot
						@else
							@foreach ( $loots[$raid->id] as $loot )
								<a href="{{ lootToLink($loot->idstring) }}" rel="{{ lootTolink($loot->idstring) }}"></a><br/>
							@endforeach
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop