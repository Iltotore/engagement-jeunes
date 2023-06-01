<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
    <link rel="stylesheet" href="{{ asset('css/references.css') }}">
    <script src="{{ asset("js/references.js") }}"></script>
</head>
<body>
@include('app_common', ['message' => "Mes références"])
<div>
    <div hidden>
        <form id="remove_form" action="/api/references/remove" method="post">
            @csrf
            <input name="selected" type="text">
        </form>

        <form id="send_form" action="/api/references/send" method="post">
            @csrf
            <input name="selected" type="text">
            <input name="email" type="email">
            <input name="duration" type="number">
        </form>
    </div>
    <div class="reference_actions">
        <button onclick="removeSelectedReferences()">Supprimer</button>
        <button onclick="toggleConsultMenu()">Envoyer à un consultant</button>
        <div id="consult_menu" hidden>
            <input name="email" type="email">
            <select name="duration">
                <option value="1">1 Jour</option>
                <option value="7" selected>1 Semaine</option>
                <option value="14">2 Semaines</option>
                <option value="30">1 Mois</option>
            </select>
            <button onclick="sendReferences()">Envoyer</button>
        </div>
    </div>
    <h1>Liste des références:</h1>
    <div class="reference_list">
        @foreach(Auth::user()->references as $ref)
            <div class="reference">
                <input class="select" name="{{ $ref->id }}" type="checkbox">
                <div class="reference_content">
                    <label class="summary">{{ $ref->ref_first_name }} {{ strtoupper($ref->ref_last_name) }}: {{ $ref->area }}</label><br>
                    <label class="description_summary">{{ trim(substr($ref->description, 0, 30)) }}...</label>
                </div>
            </div>
        @endforeach
    </div>
    <form action="api/references/add" method="post">
        @csrf
        <fieldset>
            <legend>Ajouter une référence</legend>
            <label for="descritpion">Description : <br><textarea name="description" rows="3" cols="40" style="resize: both;" required></textarea></label><br>
            <label for="area">Lieu : <input type="text" name="area" required></label><br>
            <label for="hard_skills">Savoir faire : <input type="text" name="hard_skills" required></label><br>
            <label for="soft_skills">Savoir être : <input type="text" name="soft_skills" required></label><br>
            <label for="begin_date">Date début : <input type="date" name="begin_date" required></label>
            <label for="end_date">Date fin : <input type="date" name="end_date" required></label><br>
            <label for="email">Email du référent: <input type="email" name="email" required></label><br>
            <label for="first_name">Prénom du référent: <input type="text" name="first_name" required></label><br>
            <label for="last_name">Nom du référent: <input type="text" name="last_name" required></label><br>
            <label for="birth_date">Date de naissance du référent: <input type="date" name="birth_date" required></label><br><br>
            <input type="submit" value="Ajouter référence">
        </fieldset>
    </form>
</div>
</body>
</html>
