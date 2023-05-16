<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<link rel="icon" type="image/svg+xml" href="{{ asset('svg/LOGOS_JEUNES_ICON.svg') }}">
		<title>JEUNES 6.4</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('css/home.css') }}">
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
			<div id="home_grid">
				<div>
					<h1>De quoi s'agit-il ?</h1>
					<p>
					D'une opportunité : celle qu'un engagement quel qu'il soit puissue être considéré à sa juste valeur.</br>
					Toute expérience est source d'enrichissement et doit être reconnu largement.</br>
					Elle révèle un potentiel, l'expression d'un savoir-être à concrétiser.
					</p>
				</div>

				<div>
					<h1>À qui s'adresse-t'il ?</h1>
					<p>
					À vous, jeunes entre 16 et 30 ans, qui vous êtes investis spontanément dans une association ou dans tout type d'action formelle ou informelle, et qui avez partagé de votre temps, de votre énergie, pour apporter un soutien, une aide, une compétence.</br></br>
					À vous, responsables de structures ou référents d'un jour, qui avez croisé la route de ces jeune et avez bénéficié même ponctuellement de cette implication citoyenne !</br>
					C'est l'occasion de vous engager à votre tour pour ces jeunes en confirmant leur richesse pour en avoir été un temps les témoins mais aussi les bénéficiaires !
					</p>
				</div>

				<div>
					<p>À vous, employeurs, recruteurs en ressources humaines, représentants d'organismes de formation, qui recevez ces jeunes, pour un emploi, un stage, un cursus de qualification, pour qui le savoir-être constitue le premier fondement de toute capacité humaine.</p>
					<h3>Cet engagement est une ressource à valoriser au fil d'un parcours en 3 étapes :</h3>
				</div>
			</div>

			<div id="home_links_grid">
				<a id="home_link_valorisation" class="home_box" href="/jeune">
					<div class="home_box_top_part">
						<p>1ère étape</p>
						<p>la valorisation</p>
					</div>
					<div class="home_box_bottom_part">
						<p>Décrivez votre expérience et mettez en avant ce que vous avez retiré.</p>
					</div>
				</a>

				<a id="home_link_confirmation" class="home_box" href="/referent">
					<div class="home_box_top_part">
						<p>2ème étape</p>
						<p>la confirmation</p>
					</div>
					<div class="home_box_bottom_part">
						<p>Confirmez cette expérience et ce que vous avez pu constater au contact de ce jeune.</p>
					</div>
				</a>

				<a id="home_link_consultation" class="home_box" href="/consultant">
					<div class="home_box_top_part">
						<p>3ème étape</p>
						<p>la consultation</p>
					</div>
					<div class="home_box_bottom_part">
						<p>Validez cet engagement en prenant en compte sa valeur.</p>
					</div>
				</a>
			</div>
		</div>
	</body>
</html>
