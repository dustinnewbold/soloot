@extends('master')

@section('content')
	<h1>
		Loot Tracker
	</h1>
	<a href="{{ route('raids.index') }}" class="btn btn-blue btn-block">
		Raid History
	</a>
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
				<th class="text-center">
					Loot Recieved Date
				</th>
				<th class="text-right">
					Attendance
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
							<a href="{{ route('items.show', $loots[$member->id]->wowid) }}" rel="{{ lootToLink($loots[$member->id]->idstring) }}">
								{{ $loots[$member->id]->name }}
							</a>
						@endif
					</td>
					<td class="text-center">
						@if ( ! empty($loots[$member->id]) )
							{{ round((time() - $loots[$member->id]->time) / 86400) }} days ago
						@endif
					</td>
					<td class="text-right">
						@if ( empty($raidAttendance[$member->id]) )
							<?php $raidAttendance[$member->id] = 0; ?>
						@endif
						{{ $raidAttendance[$member->id] }} / {{ $totalRaids }}
						({{ $raidAttendance[$member->id] / $totalRaids * 100 }}%)
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop