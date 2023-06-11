<body>
    <p>
        Bonjour {{ $user->first_name }}.<br>

        Votre demande de référence envoyée à {{ $reference->ref_first_name }} {{ $reference->ref_last_name }} a été confirmée.<br>

        Consultez-la sur {{ \Illuminate\Support\Facades\URL::to("/account") }}
    </p>
</body>
