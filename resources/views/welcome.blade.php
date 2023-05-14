<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<title>JEUNES 6.4</title>
		<meta charset="utf-8">
		<style type="text/css">
			body {
				margin: 0;
				text-align:center;
				font-family: 'Arial', sans-serif;
				overflow: auto;
			}

			div#welcome_background {
				margin-top:0;
				background: linear-gradient(to right, #fdfdfd, lightgrey);
				height: calc(100vh - 8em);
				min-height: 45em;
				width: 100vw;
				box-sizing: border-box;
				padding: 10px;
			}

			h1#motto_text {
				font-size: 3em;
				color: darkblue;
				letter-spacing: 0.05em;
				font-weight:lighter;
			}

			h3#motto_text_2 {
				font-size: 1.8em;
				color: darkblue;
				font-weight:lighter;
			}

			a#enter_button {
				font-size: 2em;
				color: red;
				text-decoration: none;
				display: inline-block;
			}

			div#footer_area {
				height:8em;
				display: flex;
				justify-content: center;
				align-items: center;
			}

			div#footer_area p {
				color:grey;
				max-width: 40vw;
				font-size: 1.07em;
				margin: 0 auto;
			}
		</style>
	</head>
	<body>
		<div id="welcome_background">
			<h1 id="motto_text">Pour faire de l'engagement</br>une valeur !</h1></br>
			<img src="{{ asset('svg/LOGOS_JEUNES_WELCOME.svg') }}" height="300" xmlns="http://www.w3.org/2000/svg"/>
			<h3 id="motto_text_2">... l'expression d'un potentiel,</br>la promesse d'une richesse !</h3>
			<a href="/home" id="enter_button">ENTRER</a>
		</div>
		<div id="footer_area">
			<p>JEUNES 6.4 est un dispositif de valorisation de l’engagement des jeunes en Pyrénées-Atlantiques soutenu par l’Etat, le Conseil général, le conseil régional, les CAF Béarn-Soule et
	Pays Basque, la MSA, l’université de Pau et des pays de l’Adour, la CPAM.</p>
		</div>
	</body>
</html>
