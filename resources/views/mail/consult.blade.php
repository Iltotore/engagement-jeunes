<body>
<h1>Références de {{ $consult->user->first_name }} {{ $consult->user->last_name }}</h1>
  <p>
      Bonjour Monsieur/Madame.<br>

      {{ $consult->user->first_name }} {{ $consult->user->last_name }} vous a envoyé une liste de références.<br>

      Consultez ses références ici: {{ \Illuminate\Support\Facades\URL::to("/consult?token=" . $consult->token) }}
  </p>
</body>
