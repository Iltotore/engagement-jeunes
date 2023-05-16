<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<link rel="icon" type="image/svg+xml" href="{{ asset('svg/LOGOS_JEUNES_ICON.svg') }}">
		<title>JEUNES 6.4</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<!-- Link proper stylesheet here, for example : <link rel="stylesheet" href="{{ asset('css/home.css') }}"> -->
	</head>
	<body>
		<div id="top_bars">
			<div id="motto_bar">
				<img id="logo" src="{{ asset('svg/LOGOS_JEUNES.svg') }}" height="100%" xmlns="http://www.w3.org/2000/svg"/>
				<div id="right_side">
					<h1 id="motto_text">Pour faire de l'engagement une valeur</h1>
				</div>
			</div>
			<div id="tab_bar">
				<a id="jeune_button" href="/jeune">JEUNE</a>
				<a id="referent_button" href="/referent">RÉFÉRENT</a>
				<a id="consultant_button" href="/consultant">CONSULTANT</a>
				<a id="partners_button" href="/partners">PARTENAIRES</a>
			</div>
		</div>
		<div class="content_space">
			<!-- Content of the page goes here -->
		</div>
	</body>
</html>
