<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
</head>
<body>
@include('app_common', ['message' => "Mon profil"])

<div>
    <form action="/updatesettings" method="post">
        <fieldset>
            <legend>Paramètres</legend>
            <label for="email">Email:<input type="email" name="email" value="{{ Auth::user()->email }}" required></label><br>
            <label for="password">Mot de passe (8 caractères minimum):<input type="password" name="password" minlength="8" required></label><br>
            <label for="confirm">Confirmer le mot de passe:<input type="password" name="confirm" required></label><br>
            <label for="first_name">Prénom:<input type="text" name="first_name" value="{{ Auth::user()->first_name }}" required></label><br>
            <label for="last_name">Nom:<input type="text" name="last_name" value="{{ Auth::user()->last_name }}" required></label><br>
            <label for="birth_date">Date de naissance:<input type="date" name="birth_date" value="{{ Auth::user()->birth_date }}" required></label><br>
            <input type="submit" value="Modifier">
        </fieldset>
    </form>
</div>

</body>
</html>
