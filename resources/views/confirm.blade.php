<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
</head>
<body>
	<!-- This page is used when the user has confirmed his account's creation. -->

    @include('app_common', ['message' => "Excellent !"])
    <p>Votre compte a été confirmé.</p>
    <a href="/home">Revenir à l'accueil</a>
</body>
