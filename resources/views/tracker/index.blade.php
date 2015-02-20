@extends('master')

@section('content')
	<h1>
		Loot Tracker
	</h1>
	<table>
		<thead>
			<tr>
				<th>
					Name
				</th>
				<th>
					Cooldown
				</th>
				<th>
					Last Loot Received
				</th>
				<th>
					Loot Recieved Date
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $members as $member )
				<tr data-href="{{ route('members.show', strtolower($member->name)) }}">
					<td class="{{ strtolower($classes[$member->class_id]->name) }}">
						<a href="{{ route('members.show', strtolower($member->name)) }}">
							{{ $member->name }}
						</a>
					</td>
					<td>
						@if ( $member->cooldown == 0 )
							<span class="green">
								OFF COOLDOWN
							</span>
						@else
							<span class="red">
								CD ({{ $member->cooldown }} raids)
							</span>
						@endif
					</td>
					<td>
						@if ( ! empty($loots[$member->id]) )
							<a href="{{ route('items.show', $loots[$member->id]->wowid) }}" rel="{{ lootToLink($loots[$member->id]->idstring) }}" target="_blank">
								{{ $loots[$member->id]->name }}
							</a>
						@endif
					</td>
					<td>
						@if ( ! empty($loots[$member->id]) )
							{{ round((time() - $loots[$member->id]->time) / 86400) }} days ago
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop