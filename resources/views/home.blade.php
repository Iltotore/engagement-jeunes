<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Projet PHP</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

</head>
<body>
<p>Bonjour !</p>
@auth
    <p>Je suis authentifié</p>
    <p> Nom: {{ Auth::user()->last_name }}</p>
    <p>References: {{ Auth::user()->references()->get() }}</p>
    <p>Hard skills: {{ implode(" et ", Auth::user()->references()->first()->hardSkills()) }}</p>
@else
    <p>Je ne suis PAS authentifié</p>
@endauth
</body>
