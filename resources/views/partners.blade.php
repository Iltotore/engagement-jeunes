<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
	<link rel="stylesheet" href="{{ asset('css/partners.css') }}">
</head>
<body>
    @include('app_common', ['message' => "Des partenaires tout aussi engagés"])
    <p>
        JEUNES 6.4 est un dispositif issu de la <a href="#">charte de l’engagement</a> pour la
        jeunesse signée en 2013 par des partenaires institutionnels...
    </p>
    <br>
	<div id="icon_zone">
		<img src="{{ asset('img/republique-francaise.png') }}" alt="République Française" height="200px"/>
		<img src="{{ asset('img/region-aquitaine.png') }}" alt="Région Aquitaine" height="200px"/>
		<img src="{{ asset('img/pyrenees-atlantiques2.png') }}" alt="Pyrénées Atlantiques conseil général" height="200px"/>
		<img src="{{ asset('img/assurance-maladie.png') }}" alt="l'assurance maladie" height="200px"/>
		<img src="{{ asset('img/assise-de-la-jeunesse.png') }}" alt="Assises de la jeunesse" height="200px"/>
		<div>
			<img src="{{ asset('img/caf-bearn.et.soule.png') }}" alt="Caf Béarn et Soule" style="width:100px;height:200px"/>
			<img src="{{ asset('img/caf-pays-basque.png') }}" alt="Caf du Pays Basque et du Seignanx" style="width:100px;height:200px"/>
		</div>
		<img src="{{ asset('img/msa2.png') }}" alt="MSA" height="200px"/>
		<img src="{{ asset('img/universite-pau.png') }}" alt="Université de Pau et des pays de l'adour" height="200px"/>
	</div>
    <br>
    <p>
        ...qui ont décidé de mettre en commun leurs actions pour les jeunes
        des Pyrénées-Atlantiques.
    </p>
</body>
</html>
