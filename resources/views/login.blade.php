<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" type="image/svg+xml" href="{{ asset('svg/LOGOS_JEUNES_ICON.svg') }}">
    <title>JEUNES 6.4</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style type="text/css">

    </style>
</head>
<body>
    <form action="/auth" method="get">
        <label for="email">Entrer votre adresse mail:<input type="email" name="email" required></label><br>
        <label for="password">Entrer votre mot de passe:<input type="password" name="password" required></label><br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
