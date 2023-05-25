<body>
<h1>Confirmez la demande de {{ $reference->user->first_name }} {{ $reference->user->last_name }}</h1>
  <p>
      Bonjour Monsieur/Madame {{ $reference->ref_last_name }}.

      {{ $reference->user->first_name }} {{ $reference->user->last_name }} vous a envoyé une demande de référence.
      Confirmez-la ici: {{ \Illuminate\Support\Facades\URL::to("/confirm_ref?token=" . $reference->token) }}
  </p>
</body>
