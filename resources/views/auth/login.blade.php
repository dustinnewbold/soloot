@extends('master')

@section('content')
	<form method="POST" action="{{ url('/auth/login') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<fieldset>
			<label>
				Username:
			</label>
			<input type="text" name="username">
			
			<label>
				Password:
			</label>
			<input type="password" name="password">
		</fieldset>
		<input type="submit" value="Login"></input>
	</form>
@endsection
