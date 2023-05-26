<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
</head>
<body>
@include('app_common', ['message' => "Référence de ".$reference->user->first_name])
<div>
    <label>Jeune: {{ $reference->user->first_name }} {{ $reference->user->last_name }}</label><br>
    <label>Description:</label><br>
    <p>{{ $reference->description }}</p>
    <label>Lieu: {{ $reference->area }}</label><br>
    <label>Durée: {{ $reference->timeDuration() / (24*3600) }} jours</label><br>
    <label>Savoir-faire:</label>
    <ul>
        @foreach($reference->hardSkills() as $skill)
            <li>{{ $skill }}</li>
        @endforeach
    </ul><br>
    <label>Savoir-être:</label>
    <ul>
        @foreach($reference->softSkills() as $skill)
            <li>{{ $skill }}</li>
        @endforeach
    </ul><br>

    <form action="/api/references/edit" method="post">
        @csrf
        <fieldset>
            <input type="hidden" name="token" value="{{ $reference->token }}">
            <label for="hard_skills">Savoir faire : <input type="text" name="hard_skills" required value="{{ $reference->hard_skill_values }}"></label><br>
            <label for="soft_skills">Savoir être : <input type="text" name="soft_skills" required value="{{ $reference->soft_skill_values }}"></label><br>
            <input type="submit" value="Confirmer les changements">
        </fieldset>
    </form>

    <form action="/api/references/confirm" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $reference->token }}">
        <input type="submit" value="Confirmer la référence">
    </form>
</div>
</body>
</html>
