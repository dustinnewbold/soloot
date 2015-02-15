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
				@foreach ( $raids as $raid )
					<th>
						<a href="{{ route('raids.show', $raid->id) }}">
							{{ date('M d', $raid->start_time) }}
						</a>
					</th>
				@endforeach
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
					@foreach ( $raids as $raid )
						<td>
							@if ( ! $raid->getLoot($member->id)->isEmpty() )
								@foreach ( $raid->getLoot($member->id) as $loot )
									<a href="https://www.wowhead.com/{{ $loot->getLink() }}" rel="{{ $loot->getLink() }}" target="_blank"></a><br/>
								@endforeach
							@endif
						</td>
					@endforeach
				</tr>
			@endforeach
		</tbody>
	</table>
@stop