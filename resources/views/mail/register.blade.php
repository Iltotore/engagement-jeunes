<body>
  <h1>Inscription</h1>
  <label>
      Bonjour {{ $user->first_name }} !
      Inscrivez-vous ici: {{ \Illuminate\Support\Facades\URL::to("/confirm?token=" . $user->registration_token) }}
  </label>
</body>
