@extends('master')

@section('content')
	<h1>
		{{ $raid->zone->name }} on {{ date('M d Y', $raid->start_time) }}
	</h1>
	<span>
		From {{ date('h:i:s A', $raid->start_time) }} to {{ date('h:i:s A', $raid->end_time) }}
	</span>

	<table>
		<thead>
			<tr>
				<th>
					Member
				</th>
				<th>
					Joined
				</th>
				<th>
					Left
				</th>
				<th>
					Loot Received
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $members as $member )
				<tr class="{{ strtolower($classes[$member->class_id]->name) }}" data-href="{{ strtolower(route('members.show', $member->name)) }}">
					<td>
						{{ $member->name }}
					</td>
					<td>
						{{ date('h:i:s A', $member->join_time) }}
					</td>
					<td>
						{{ date('h:i:s A', $member->leave_time) }}
					</td>
					<td>
						@if ( ! empty($loots[$member->id]) )
							@foreach ( $loots[$member->id] as $loot )
								<a href="#" rel="{{ lootToLink($loot->idstring) }}"></a><br/>
							@endforeach
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop