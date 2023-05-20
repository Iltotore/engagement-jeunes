<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
</head>
<body>
  @include('app_common', ['message' => "Mail d'inscription envoyé !"])
  <p>
      Un mail de confirmation a été envoyé à l'adresse suivante: {{ Session::get("user")->email }}.<br>
      Vous avez jusqu'au {{ Session::get("user")->expire_at }} pour confirmer votre inscription.
  </p>
</body>
