<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
    <script src="{{ asset('js/skill.js') }}"></script>
</head>
<body>
@include('app_common', ['message' => "Référence de ".$reference->user->first_name])
<form id="edit_form" action="/api/references/edit" method="post" hidden>
    @csrf
    <input type="hidden" name="token" value="{{ $reference->token }}">
    <input type="text" name="hard_skills">
    <input type="text" name="soft_skills">
</form>
<label>Jeune: {{ $reference->user->first_name }} {{ $reference->user->last_name }}</label><br>
<label>Description:</label><br>
<p>{{ $reference->description }}</p>
<label>Lieu: {{ $reference->area }}</label><br>
<label>Durée: {{ $reference->timeDuration() / (24*3600) }} jours</label><br>
<div>
    <label>Savoir-faire:</label>
    <input name="hard_skill" type="text">
    <button onclick="addSkill('hard')">Ajouter</button>
    <ul id="hard_skills">
        @foreach($reference->hardSkills() as $skill)
            <li id="ref_{{ $skill }}">{{ $skill }}<button onclick="this.parentNode.remove()">-</button></li>
        @endforeach
    </ul>
</div>
<br>
<div>
    <label>Savoir-être:</label>
    <input name="soft_skill" type="text">
    <button onclick="addSkill('soft')">Ajouter</button>
    <ul id="soft_skills">
        @foreach($reference->softSkills() as $skill)
            <li id="ref_{{ $skill }}">{{ $skill }}<button onclick="this.parentNode.remove()">-</button></li>
        @endforeach
    </ul>
</div>
<br>
<button onclick="sendEdit()">Confirmer les modifications</button>

<form action="/api/references/confirm" method="post">
    @csrf
    <input type="hidden" name="token" value="{{ $reference->token }}">
    <input type="submit" value="Confirmer la référence">
</form>
</div>
</body>
</html>
