@extends('master')

@section('content')
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
					Attendance (30/60/90)
				</th>
				@foreach ( $raids as $raid )
					<th>
						{{ date('M d', $raid->start_time) }}
					</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			@foreach ( $members as $member )
				<tr>
					<td>
						{{ $member->name }}
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
						ATTENDANCE
					</td>
					@foreach ( $raids as $raid )
						<td>
							{{ $raid->getLoot($member->id) }}
						</td>
					@endforeach
				</tr>
			@endforeach
		</tbody>
	</table>
@stop