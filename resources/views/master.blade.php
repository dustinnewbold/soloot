<!DOCTYPE html>
<html>
<head>
	<title>
		@yield('title', 'Loot Tracker')
	</title>
	<link rel="stylesheet" type="text/css" href="http://shatteredoath.com/css/main.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans|Rock+Salt' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="container">
		<header>
			<nav class="top_nav">
				<ul>
					<li>
						<a href="https://docs.google.com/forms/d/1JIXPKXYYRQElqh8thbSSMXi4WIWrNX7rglzRfJHlxDA/viewform" target="_blank">APPLY</a>
					</li>
					<li>
						<a href="https://twitter.com/shatteredoathED" target="_blank">TWITTER</a>
					</li>
					<li>
						<a href="/forum">FORUMS</a>
					</li>
					<li>
						<a href="{{ url('/') }}">LOOT</a>
					</li>
					<li>
						<a href="/roster.php">ROSTER</a>
					</li>
					<li>
						<a href="/">HOME</a>
					</li>
				</ul>
			</nav>
			<img src="http://www.shatteredoath.com/img/so-logo-text.png" alt="Awesome Shattered Oath Logo" class="logo">
			<div id="header_text">
				<p>Est. 2006: Eight years of raiding excellence on Emerald Dream.</p>
			</div>
			<div class="clear"></div>
		</header>
		@if ( Session::get('message') )
			<div class="alert alert-{{ Session::get('type') ?: 'error' }}">
				{{ Session::get('message') }}
			</div>
		@endif
		<div class="content">
			@yield('breadcrumbs')
			@yield('content')
		</div>
	</div>

	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="{{ asset('js/jquery.datahref.js') }}"></script>
	<script type="text/javascript" src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="http://static.wowhead.com/widgets/power.js"></script>
	<script>var wowhead_tooltips = { "colorlinks": true, "iconizelinks": true, "renamelinks": true }</script>
	<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</body>
</html>