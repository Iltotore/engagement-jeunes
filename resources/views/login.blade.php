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
<div>

    <form action="/auth" method="get">
        <fieldset>
            <legend>Connexion</legend>
            <label for="email">Entrer votre adresse mail:<input type="email" name="email" required></label><br>
            <label for="password">Entrer votre mot de passe:<input type="password" name="password" required></label><br>
            <label for="remember">Se souvenir de moi<input type="checkbox" name="remember"></label>
            <input type="submit" value="Se connecter">
        </fieldset>

    </form>
</div>
<div>

    <form action="/register" method="get">
        <fieldset>
            <legend>Inscritpion</legend>
            <label for="email">Email:<input type="email" name="email" required></label><br>
            <label for="password">Mot de passe (8 caractères minimum):<input type="password" name="password"
                                                                             minlength="8" required></label><br>
            <label for="confitm">Confirmer le mot de passe:<input type="password" name="confirm" required></label><br>
            <label for="first_name">Prénom:<input type="text" name="first_name" required></label><br>
            <label for="last_name">Nom:<input type="text" name="last_name" required></label><br>
            <label for="birth_date">Date de naissance:<input type="date" name="birth_date" required></label><br>
            <input type="submit" value="S'inscrire">
        </fieldset>
    </form>
</div>
</body>
</html>
