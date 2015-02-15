<!DOCTYPE html>
<html>
<head>
	<title>
		Loot Tracker
	</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/main.css') }}">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css">
</head>
<body>
	<div class="container">
		@yield('content')
	</div>


	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="{{ asset('js/jquery.datahref.js') }}"></script>
	<script type="text/javascript" src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="http://static.wowhead.com/widgets/power.js"></script>
	<script>var wowhead_tooltips = { "colorlinks": true, "iconizelinks": true, "renamelinks": true }</script>
	<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</body>
</html>