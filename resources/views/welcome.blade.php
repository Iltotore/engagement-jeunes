<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<link rel="icon" type="image/svg+xml" href="{{ asset('svg/LOGOS_JEUNES_ICON.svg') }}">
		<title>JEUNES 6.4</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
	</head>
	<body>
		<div id="welcome_background">
			<h1 id="motto_text">Pour faire de l'engagement</br>une valeur !</h1></br>
			<img id="jeunes_logo" src="{{ asset('svg/LOGOS_JEUNES.svg') }}" xmlns="http://www.w3.org/2000/svg"/>
			<h3 id="motto_text_2">... l'expression d'un potentiel,</br>la promesse d'une richesse !</h3>
			<a href="/home" id="enter_button">ENTRER</a>
		</div>
		<div id="footer_area">
			<p>JEUNES 6.4 est un dispositif de valorisation de l’engagement des jeunes en Pyrénées-Atlantiques soutenu par l’Etat, le Conseil général, le conseil régional, les CAF Béarn-Soule et
	Pays Basque, la MSA, l’université de Pau et des pays de l’Adour, la CPAM.</p>
		</div>
	</body>
</html>
