<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
</head>
<body>
    @include('app_common', ['message' => "Je m'engage"])
    <p>
        JEUNES 6.4 est un dispositif issu de la charte de l’engagement pour la
        jeunesse signée en 2013 par des partenaires institutionnels...
    </p>
    <br>
    <img src="img/republique-francaise.png" alt="République Française" style="width:300px;height:200px"/>
    <img src="img/region-aquitaine.png" alt="Région Aquitaine" style="width:300px;height:200px"/>
    <img src="img/pyrenees-atlantiques2.png" alt="Pyrénées Atlantiques conseil général" style="width:300px;height:200px"/>
    <img src="img/assurance-maladie.png" alt="l'assurance maladie" style="width:300px;height:200px"/>
    <img src="img/assise-de-la-jeunesse.png" alt="Assises de la jeunesse" style="width:300px;height:200px"/>
    <img src="img/caf-bearn.et.soule.png" alt="Caf Béarn et Soule" style="width:100px;height:200px"/>
    <img src="img/caf-pays-basque.png" alt="Caf du Pays Basque et du Seignanx" style="width:100px;height:200px"/>
    <img src="img/msa2.png" alt="MSA" style="width:300px;height:200px"/>
    <img src="img/universite-pau.png" alt="Université de Pau et des pays de l'adour" style="width:300px;height:200px"/>
    <br>
    <p>
        ...qui ont décidé de mettre en commun leurs actions pour les jeunes
        des Pyrénées-Atlantiques.
    </p>
</body>
</html>
