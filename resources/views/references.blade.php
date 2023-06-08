<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head_common')
    <link rel="stylesheet" href="{{ asset('css/references.css') }}">
    <script src="{{ asset('js/references.js') }}"></script>
</head>
<body>
@include('app_common', ['message' => "Mes références"])
<div>
    <div hidden>
        <form id="ref_remove_form" action="/api/references/remove" method="post">
            @csrf
            <input name="selected" type="text">
        </form>

        <form id="ref_send_form" action="/api/references/send" method="post">
            @csrf
            <input name="selected" type="text">
            <input name="email" type="email">
            <input name="duration" type="number">
        </form>

        <form id="consult_remove_form" action="/api/consults/remove" method="post">
            @csrf
            <input name="selected" type="text">
        </form>

		<form id="generation_form" action="/references/summarize" method="post">
			@csrf
			<input name="selected" type="text">
			<input type="radio" name="summary_type" value="PDF" checked><label for="PDF">PDF</label>
			<input type="radio" name="summary_type" value="HTML"><label for="HTML">HTML</label>
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

		<button onclick="toggleMenu(document.getElementById('generation_menu'))">Générer une page de résumé</button>
		<div id="generation_menu" hidden>
			<fieldset>
            	<input type="radio" name="summary_type" value="PDF" checked><label for="PDF">PDF</label></br>
				<input type="radio" name="summary_type" value="HTML"><label for="HTML">HTML</label></br>
				<button onclick="generateSummary()">Générer le résumé</button>
			</fieldset>
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
    <div class="consult_actions">
        <button onclick="removeSelectedConsults()">Supprimer</button>
    </div>
    <h1>Liste des consultations:</h1>
    <div class="consult_list">
        @foreach(Auth::user()->consults as $consult)
            <div class="consult">
                <input class="select" name="{{ $consult->id }}" type="checkbox">
                <div class="consult_content">
                    <!-- TODO Add email column to consults --> 
                    <label>Envoyée à: ...</label>
                    <label>References: </label>
                    <button onclick="toggleReferences(this)">+</button>
                    <div class="reference_container" hidden>
                        @foreach($consult->references as $ref)
                        <div class="reference_content">
                            <label class="summary">{{ $ref->ref_first_name }} {{ strtoupper($ref->ref_last_name) }}: {{ $ref->area }}</label><br>
                            <label class="description_summary">{{ trim(substr($ref->description, 0, 30)) }}...</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
