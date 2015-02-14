<!DOCTYPE html>
<html>
<head>
	<title>
		test
	</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/main.css') }}">
</head>
<body>
	<div class="container">
		@yield('content')
	</div>


	<script type="text/javascript" src="http://static.wowhead.com/widgets/power.js"></script>
	<script>var wowhead_tooltips = { "colorlinks": true, "iconizelinks": true, "renamelinks": false }</script>
</body>
</html>