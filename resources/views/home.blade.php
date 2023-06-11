<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		@include('head_common')
		<link rel="stylesheet" href="{{ asset('css/home.css') }}">
	</head>
	<body>
		@include('app_common', ['message' => "Pour faire de l'engagement une valeur"])

		<!-- This is the area that contains the content of the home page. -->
		<div class="content_space">

			<!-- We present here the project to the visitor. -->
			<div id="home_grid">
				<div>
					<h1>De quoi s'agit-il ?</h1>
					<p>
					D'une opportunité : celle qu'un engagement quel qu'il soit puisse être considéré à sa juste valeur.</br>
					Toute expérience est source d'enrichissement et doit être reconnue largement.</br>
					Elle révèle un potentiel, l'expression d'un savoir-être à concrétiser.
					</p>
				</div>

				<div>
					<h1>À qui s'adresse-t'il ?</h1>
					<p>
					À vous, jeunes entre 16 et 30 ans, qui vous êtes investis spontanément dans une association ou dans tout type d'action formelle ou informelle, et qui avez partagé de votre temps, de votre énergie, pour apporter un soutien, une aide, une compétence.</br></br>
					À vous, responsables de structures ou référents d'un jour, qui avez croisé la route de ces jeunes et avez bénéficié, même ponctuellement, de cette implication citoyenne !</br>
					C'est l'occasion de vous engager à votre tour pour ces jeunes en confirmant leur richesse pour en avoir été un temps les témoins, mais aussi les bénéficiaires !
					</p>
				</div>

				<div>
					<p>À vous, employeurs, recruteurs en ressources humaines, représentants d'organismes de formation, qui recevez ces jeunes, pour un emploi, un stage, un cursus de qualification, pour qui le savoir-être constitue le premier fondement de toute capacité humaine.</p>
					<h3>Cet engagement est une ressource à valoriser au fil d'un parcours en 3 étapes :</h3>
				</div>
			</div>

			<!-- We present here the 3 steps of the project. -->
			<div id="home_links_grid">
				<a id="home_link_valorisation" class="home_box" href="/account">
					<div class="home_box_top_part">
						<p>1ère étape</p>
						<p>la valorisation</p>
					</div>
					<div class="home_box_bottom_part">
						<p>Décrivez votre expérience et mettez en avant ce que vous avez retiré.</p>
					</div>
				</a>

				<div id="home_link_confirmation" class="home_box">
					<div class="home_box_top_part">
						<p>2ème étape</p>
						<p>la confirmation</p>
					</div>
					<div class="home_box_bottom_part">
						<p>Confirmez cette expérience et ce que vous avez pu constater au contact de ce jeune.</p>
					</div>
				</div>

				<div id="home_link_consultation" class="home_box">
					<div class="home_box_top_part">
						<p>3ème étape</p>
						<p>la consultation</p>
					</div>
					<div class="home_box_bottom_part">
						<p>Validez cet engagement en prenant en compte sa valeur.</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
