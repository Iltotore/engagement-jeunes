<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
    <link rel="stylesheet" href="{{ asset('css/registered.css') }}">
</head>
<body>
	<!-- This page is used when the user has just registered. -->

  	@include('app_common', ['message' => "Mail d'inscription envoyé !"])
  	<p>
    	Un mail de confirmation a été envoyé à l'adresse suivante: {{ Session::get("user")->email }}.<br>
    	Vous avez jusqu'au {{ Session::get("user")->expire_at }} pour confirmer votre inscription.
  	</p>
</body>
