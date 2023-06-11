<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
	<link rel="stylesheet" href="{{ asset('css/partners.css') }}">
</head>
<body>
    @include('app_common', ['message' => "Des partenaires tout aussi engagés"])
    <p>
        JEUNES 6.4 est un dispositif issu de la <a href="http://test.le64.fr/uploads/tx_arccg64/charte2013.pdf">charte de l’engagement</a> pour la
        jeunesse signée en 2013 par des partenaires institutionnels...
    </p>
    <br>
	<div id="icon_zone">
		<img src="{{ asset('img/republique-francaise.png') }}" alt="République Française"/>
		<img src="{{ asset('img/region-aquitaine.png') }}" alt="Région Aquitaine"/>
		<img src="{{ asset('img/pyrenees-atlantiques2.png') }}" alt="Pyrénées Atlantiques conseil général"/>
		<img src="{{ asset('img/assurance-maladie.png') }}" alt="l'assurance maladie"/>
		<img src="{{ asset('img/assise-de-la-jeunesse.png') }}" alt="Assises de la jeunesse"/>
		<div>
			<img src="{{ asset('img/caf-bearn.et.soule.png') }}" alt="Caf Béarn et Soule"/>
			<img src="{{ asset('img/caf-pays-basque.png') }}" alt="Caf du Pays Basque et du Seignanx"/>
		</div>
		<img src="{{ asset('img/msa2.png') }}" alt="MSA"/>
		<img src="{{ asset('img/universite-pau.png') }}" alt="Université de Pau et des pays de l'adour"/>
	</div>
    <br>
    <p>
        ...qui ont décidé de mettre en commun leurs actions pour les jeunes
        des Pyrénées-Atlantiques.
    </p>
</body>
</html>
