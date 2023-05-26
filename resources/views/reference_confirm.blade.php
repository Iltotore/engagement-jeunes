<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
</head>
<body>
    @include('app_common', ['message' => "Excellent !"])
    <p>Cette référence a été confirmée.</p>
    <a href="/home">Revenir à l'accueil</a>
</body>
